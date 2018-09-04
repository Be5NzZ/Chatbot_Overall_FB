'use strict'
const vtoken = 'tokengg'
const token = 'EAAeaMmUlJQ0BAIakORem0ElMwO1oExm9mswEauReDicxdAXBuU2BpY351qyDr5EU3sTCmZBdNPYWQZCB3Wjtyc0ZBBonTsERLCK7wYW8DklVOdMeSQyjtoeZBP7VFKcBGN0W0ZAAB5OoL5Nin0LmLfzZAZA2csrmV8KsCaa64dsOwZDZD'

const express = require('express')
const bodyParser = require('body-parser')
const request = require('request')
const app = express()

app.set('port', (process.env.PORT || 5000))

// Process application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({extended: false}))

// Process application/json
app.use(bodyParser.json())

// Index route
app.get('/', function (req, res) {
    res.send('Hello , I am a chat bot')
})

// for Facebook verification
app.get('/webhook/', function (req, res) {
if (req.query['hub.mode'] === 'subscribe' &&
      req.query['hub.verify_token'] === vtoken) {
    console.log("Validating webhook");
    res.status(200).send(req.query['hub.challenge']);
  } else {
    console.error("Failed validation. Make sure the validation tokens match.");
    res.sendStatus(403);          
  }  
});
    

// Spin up the server
app.listen(app.get('port'), function() {
    console.log('running on port', app.get('port'))
})
//.................................................................................................
app.post('/webhook/', function (req, res) {
    var data = req.body;

  // Make sure this is a page subscription
  if (data.object === 'page') {

    // Iterate over each entry - there may be multiple if batched
    data.entry.forEach(function(entry) {
      var pageID = entry.id;
      var timeOfEvent = entry.time;

      // Iterate over each messaging event
      entry.messaging.forEach(function(event) {
        if (event.message) {
          receivedMessage(event);
        } else {
          console.log("Webhook received unknown event: ", event);
        }
      });
    });

    // Assume all went well.
    //
    // You must send back a 200, within 20 seconds, to let us know
    // you've successfully received the callback. Otherwise, the request
    // will time out and we will keep trying to resend.
    res.sendStatus(200);
  }
  })

//.......................Code Facebook
function receivedMessage(event) {
  var senderID = event.sender.id;
  var recipientID = event.recipient.id;
  var timeOfMessage = event.timestamp;
  var message = event.message;

  console.log("Received message for user %d and page %d at %d with message:", 
    senderID, recipientID, timeOfMessage);
  console.log(JSON.stringify(message));

  var messageId = message.mid;

  var messageText = message.text;
  var messageAttachments = message.attachments;

  if (messageText) {

    // If we receive a text message, check to see if it matches a keyword
    // and send back the example. Otherwise, just echo the text we received.
    sendTextApiMessage(senderID, messageText)
  } else if (messageAttachments) {
    sendTextMessage(senderID, "Message with attachment received");
  }
}





//...........................................ส่งเข้าFacebook.............................................................

function sendTextMessage(sender, text) {
    let messageData = { text:text }
    request({
        url: 'https://graph.facebook.com/v2.6/me/messages',
        qs: {access_token:token},
        method: 'POST',
        json: {
            recipient: {id:sender},
            message: messageData,
        }
    }, function(error, response, body) {
        if (error) {
            console.log('Error sending messages: ', error)
        } else if (response.body.error) {
            console.log('Error: ', response.body.error)
        }
    },function (err){console.error(err);})
}

//............................................Send Api Chatbot..................................................................
function sendTextApiMessage(sender, text) {
    let messageData = { text:text }
    request({
        url: 'http://localhost:4673/WebService1.asmx/GetMessage',
        //qs: {access_token:token},
        method: 'POST',
        json: {
            //recipient: {id:sender},
            message: messageData,
        }
    }, function(error, response, body) {
         console.log(JSON.stringify(response));
        if (error) {
            console.log('Error sending messages: ', error)
        } else if (response.body.error) {

            console.log('Error: ', response.body.error)
        }
        if(body){
            console.log(body)
        }
        if(response){
           //var _responseApi = JSON.parse(response)
           request({
        url: 'https://graph.facebook.com/v2.6/me/messages',
        qs: {access_token:token},
        method: 'POST',
        //json: {"recipient":{"id":"1295935107187920"},"message":{"text":"Success :Hello Bom"}}
        json: response.body
    }, function(error, response, body) {
        if (error) {
            console.log('Error sending messages: ', error)
        } else if (response.body.error) {
            console.log('Error: ', response.body.error)
        }
    }) 
        }
    },function (err){console.error(error);})
}

//..............................................................................................................................
/*
function sendGenericMessage(sender) {
    let messageData = {
        "attachment": {
            "type": "template",
            "payload": {
                "template_type": "generic",
                "elements": [{
                    "title": "KO",
                    "subtitle": "Test Chat Bot",
                    "image_url": "https://static.wixstatic.com/media/2532c2_a09dea503c204cc096615bed14745332~mv2.jpg/v1/fill/w_390,h_270,al_c,q_80,usm_0.66_1.00_0.01/2532c2_a09dea503c204cc096615bed14745332~mv2.webp",
                    "buttons": [{
                        "type": "web_url",
                        "url": "https://www.ko.in.th/",
                        "title": "My Website"
                    }, {
                        "type": "postback",
                        "title": "Postback",
                        "payload": "Test",
                    }],
                }, {
                    "title": "Second card",
                    "subtitle": "Element #2 of an hscroll",
                    "image_url": "http://messengerdemo.parseapp.com/img/gearvr.png",
                    "buttons": [{
                        "type": "postback",
                        "title": "Postback",
                        "payload": "Payload for second element in a generic bubble",
                    }],
                }]
            }
        }
    }
    request({
        url: 'https://graph.facebook.com/v2.6/me/messages',
        qs: {access_token:token},
        method: 'POST',
        json: {
            recipient: {id:sender},
            message: messageData,
        }
    }, function(error, response, body) {
        if (error) {
            console.log('Error sending messages: ', error)
        } else if (response.body.error) {
            console.log('Error: ', response.body.error)
        }
    })
    
}
*/
