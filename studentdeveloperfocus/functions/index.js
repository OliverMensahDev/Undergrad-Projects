const functions = require('firebase-functions');
const express = require("express");
const firebase = require("firebase-admin");
const engines = require("consolidate");
const app = express();
app.engine("hbs", engines.handlebars);
app.set("views", './views');
app.set("view engine", 'hbs');

//get details of firebase 
const firebaseApp = firebase.initializeApp(
    functions.config().firebase
);
function getpeople() {
    const ref = firebaseApp.database().ref("people");
    return ref.once('value').then(snap =>snap.val());
}

function addTo(data){
    const ref =firebaseApp.database().ref("people");
    ref.push(data);
}

app.get("/", (request, response)=>{
    response.set("Cache-Control","public, max-age=300,s-manage=600");
    response.render("index");
})

app.get("/events", (request, response)=>{
    response.set("Cache-Control","public, max-age=300,s-manage=600");
    response.render("index");
})
app.get("/membership", (request, response)=>{
    response.set("Cache-Control","public, max-age=300,s-manage=600");
    response.render("index");
})

app.get("/about/:id", (request, response)=>{
    let id = request.params.id
    response.send(id)
})

app.get("/time-cached", (request, response)=>{
    response.set("Cache-Control","public, max-age=300,s-manage=600");
    response.render("index", {people});
})

app.post('/add', (req, res)=>{
    if(!req.body.name){
        res.status(400);
        res.send('Name is required');
    }
    else {
        data ={
            name: req.body.name,
            year: req.body.year,
        }
        const ref = firebaseApp.database().ref("people");
       ref.push(data).then(err =>{
           res.redirect("/");
    })
}
});

app.get("*", (req, res)=>{
    res.send("Err")
})
exports.app = functions.https.onRequest(app);
