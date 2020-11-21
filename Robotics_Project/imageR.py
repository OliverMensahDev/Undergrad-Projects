
import rospy  # ROS client API to interface ROS topics, services and parameters with python
from sensor_msgs.msg import Image # Messages about an uncompressed image 
from std_msgs.msg import String    # A ROS Primitive type for pub/sub a string data type
from cv_bridge import CvBridge    # Converts ROS images to OpenCV format
import cv2              
import numpy as np
import tensorflow as tf   #tensorflow 
from tensorflow.models.image.imagenet import classify_image  # access to tensorflow trained model 


class ImageRecognition():
    # creating an execution scope for tensorflow while download the model.
    # Sets up a publishing and subscribing node to human readable image node.
    def __init__(self):
        classify_image.maybe_download_and_extract()  
        self._session = tf.Session()		      
        classify_image.create_graph()		     
        self._cv_bridge = CvBridge()
        self._sub = rospy.Subscriber('image', Image, self.callback, queue_size=1) 
        self._pub = rospy.Publisher('output', String, queue_size=1) 
        self.score_threshold = rospy.get_param('~score_threshold', 0.1)
        self.use_top_k = rospy.get_param('~use_top_k', 5)

# params: image msg
# image msg convered to readable openCV format
# openCV format which is a numpy array is converted to string
# the resulting strings are passed into tensorflow to be lookup in the model labels
    def callback(self, image_msg):
        cv_image = self._cv_bridge.imgmsg_to_cv2(image_msg, "bgr8")
        image_data = cv2.imencode('.jpg', cv_image)[1].tostring()
        softmax_tensor = self._session.graph.get_tensor_by_name('softmax:0')
        predictions = self._session.run(softmax_tensor, {'DecodeJpeg/contents:0': image_data})
        predictions = np.squeeze(predictions)
        node_lookup = classify_image.NodeLookup()
        top_k = predictions.argsort()[-self.use_top_k:][::-1]
        for node_id in top_k:
            human_string = node_lookup.id_to_string(node_id)
            score = predictions[node_id]
            if score > self.score_threshold:
                rospy.loginfo('%s (score = %.5f)' % (human_string, score))
                self._pub.publish(human_string)

    def main(self):
        rospy.spin() # keep running until node stops

if __name__ == '__main__':
    rospy.init_node('rostensorflow')
    tensor = ImageRecognition()
    tensor.main()
