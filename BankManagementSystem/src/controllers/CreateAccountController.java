/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controllers;

/**
 *
 * @author Peter
 */
import java.awt.Image;
import views.*;
import models.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.sql.SQLException;
import javax.swing.JOptionPane;
import java.util.Date;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.text.DateFormat; 
import java.text.DecimalFormat;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.ImageIcon;
import javax.swing.JFileChooser;
import javax.swing.JFrame;

public class CreateAccountController implements ActionListener{
    File file;
    CreateAccount add;
    Data data;
    public CreateAccountController(CreateAccount add, Data data){
        this.add = add;
        this.data = data;
        Date date = new Date();
        DateFormat defaultDf = DateFormat.getDateInstance();
        System.out.println(defaultDf.format(date));
        add.getDateCreated().setText(defaultDf.format(date));
    }
        
    public void CreateAccountControllerMethod(){
        add.getAddButton().addActionListener(this);
        add.getExitButton().addActionListener(this);
        add.chooseImage().addActionListener(this);
        add.setExtendedState(JFrame.MAXIMIZED_BOTH); 
        add.setVisible(true);
    }
    @Override 
    public void actionPerformed(ActionEvent ae){
        if(ae.getSource() == add.getExitButton()){
            add.dispose();
            HomePage home = new HomePage();
            HomePageController cont = new HomePageController(home);
            cont.HomePageControllerMethod();
        }
        if(ae.getSource()==add.chooseImage()){
            JFileChooser fc = new JFileChooser();
        int  result = fc.showOpenDialog(null);
        if(result==JFileChooser.APPROVE_OPTION){
            file = fc.getSelectedFile();
            System.out.println("Open your address file and use it for some processing");
            String path= file.getAbsolutePath();
            if(isImage(path)==true){
            add.getImagePlaceHolder().setIcon(new ImageIcon(new ImageIcon(path).getImage().getScaledInstance(100, 100, Image.SCALE_DEFAULT)));
            }else{
              JOptionPane.showMessageDialog(null, "The Selected File is not an image. Please choose and image");

            }
        }else{
            JOptionPane.showMessageDialog(null, "Choose an Image");
        }
        }
        if(ae.getSource()== add.getAddButton()){
            
                if(isInteger(add.getAccountNumber().getText().trim())==false)
                {
                    JOptionPane.showMessageDialog(null, "Account number cannot be letters");
                }
                else if(isInteger(add.getFirstname().getText().trim())==true 
                        || isInteger(add.getSurname().getText().trim())==true
                        ){
                    JOptionPane.showMessageDialog(null, "Names were left empty. Filled them");
                }
                else if(isValidPhoneNo(add.getPhoneNumber().getText().trim())==false)
                {
                    JOptionPane.showMessageDialog(null, "Phone number must be like 02444569089");
                }else if(isInteger(add.getAccountType().getText().trim())==true ){
                    JOptionPane.showMessageDialog(null, "Account type not filled");
                
                }else if(isDouble(add.getCurrentAmount().getText().trim())==false ){
                    JOptionPane.showMessageDialog(null, "AMount should be of the format 80.00 for 80 cedis");                    
               }
                else if(
                        "".equals(add.getAccountNumber().getText().trim()) || "".equals(add.getFirstname().getText().trim())
                        || "".equals(add.getSurname().getText().trim()) 
                        || "".equals(add.getPhoneNumber().getText().trim())  || "".equals(add.getAccountType().getText().trim())
                        || "".equals( add.getCurrentAmount().getText().trim())  || "".equals(add.getDateCreated().getText().trim())
                        ){
                     JOptionPane.showMessageDialog(null, "All Fields should be field\n EXCEPT client has no other name");
                }else{
                try {
                    DecimalFormat df2 = new DecimalFormat(".##");
                    double input = Double.parseDouble(add.getCurrentAmount().getText().trim());
                    String cur = df2.format(input); 
                    String path= file.getAbsolutePath();
                    if(isImage(path)==true){
                         FileInputStream fin = new FileInputStream(file);
                         int len = (int)file.length();
                         data.createAccount(
                            Integer.parseInt(add.getAccountNumber().getText().trim()), add.getFirstname().getText().trim(),
                            add.getOthername().getText().trim(),  add.getSurname().getText().trim(), 
                            add.getPhoneNumber().getText().trim(), add.getAccountType().getText().trim(),
                           Double.parseDouble(cur) , add.getDateCreated().getText().trim(),
                           fin,len
                    );
                    add.setEnabled(false);
                    emptyForm();
                    
                    }else{
                        JOptionPane.showMessageDialog(null, "The Selected File is not an image. Please choose and image \n "
                                + "Before you can add client details");

            }
                   
                    
                } catch (SQLException ex) {
                   System.out.println("The Account has already been created");
                }   catch (FileNotFoundException ex) {
                        Logger.getLogger(CreateAccountController.class.getName()).log(Level.SEVERE, null, ex);
                    }
            }      
        
    
    }
        
    }
     public boolean isInteger( String input ) {
    try {
        Integer.parseInt( input );
        return true;
    }
    catch( Exception e ) {
        return false;
    }
}
     public  boolean isValidPhoneNo(String phoneNo) {
         Pattern pattern = Pattern.compile("^[0]\\d{3}\\d{3}\\d{3}");
         Matcher matcher = pattern.matcher(phoneNo); 
         if (matcher.matches())
             return true;
         else
             return false;         
     }
    
 public boolean isDouble( String input) {
    try {
        Double.parseDouble( input );
        return true;
    }
    catch( Exception e ) {
        return false;
    }
}
 boolean isImage(String image_path){
  Image image = new ImageIcon(image_path).getImage();
  if(image.getWidth(null) == -1){
        return false;
  }
  else{
        return true;
  }
}
 public void emptyForm(){
    add.getAccountNumber().setText("");
    add.getAccountType().setText("");
    add.getCurrentAmount().setText("");
    add.getFirstname().setText("");
    add.getImagePlaceHolder();
    add.getSurname().setText("");
    add.getOthername().setText("");
    add.getPhoneNumber().setText("");
    add.getCurrentAmount().setText("");
    add.setEnabled(true);
 }
}
