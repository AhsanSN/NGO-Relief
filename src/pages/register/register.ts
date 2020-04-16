import {Component, OnInit} from "@angular/core";
import {FormGroup, Validators, FormBuilder} from '@angular/forms';
import {IonicPage, NavController} from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";
import { App } from 'ionic-angular';
import { Device } from '@ionic-native/device';

@IonicPage({
  name: 'page-register',
  segment: 'register'
})

@Component({
  selector: 'page-register',
  templateUrl: 'register.html'
})
export class RegisterPage implements OnInit {
  public onRegisterForm: FormGroup;
  name = ""
  email = ""
  password = ""
  userIdTag = ""

  constructor(public app: App, private _fb: FormBuilder, public nav: NavController, private hotelService: HotelService, private device: Device) {

  }

  ngOnInit() {
    this.onRegisterForm = this._fb.group({
      fullName: ['', Validators.compose([
        Validators.required
      ])],
      email: ['', Validators.compose([
        Validators.required
      ])],
      password: ['', Validators.compose([
        Validators.required
      ])]
    });
  }

  test(){
    console.log("device_id = this.device.uuid",  this.device.uuid)
  }

  // register and go to home page
  register(fullName, email, password) {
    
    //upload user
    var d = new Date();
    var userIdTag = ((d.getTime()).toString()+fullName);
    
    var aboutUser = {
      "name":fullName,
      "email":email,
      "password":password,
      "userIdTag": userIdTag,
      "uuid": this.device.uuid
      }
       
     console.log("value", fullName ,email, password, userIdTag )
     this.uploadUserToDatabase(aboutUser);

     this.name = fullName
     this.email = email
     this.password = password
     this.userIdTag = userIdTag;
  }

  // go to login page
  login() {
    this.app.getRootNav().setRoot('page-login');
  }

  uploadUserToDatabase(aboutUser){
    var _this = this;
         var InitiateUploadUser = function(callback) // How can I use this callback?
          {
              var request = new XMLHttpRequest();
              request.onreadystatechange = function()
              {
                  if (request.readyState == 4 && request.status == 200)
                  {
                      callback(request.responseText); // Another callback here
                  }
                  if (request.readyState == 4 && request.status == 0)
                  {
                      console.log("no respinse for creating account") // Another callback here
                      //document.getElementById("noInternet").style.display = "block";
                  }
              }; 
              request.open("POST", "https://api.anomoz.com/api/ngo-relief/post/user_create.php")
              request.send(JSON.stringify(aboutUser));
          }
          var frameUploadUser = function mycallback(data) {
            console.log("user received from server," , data)

            
            _this.hotelService.storeSignupData(_this.name, _this.email, _this.password, _this.userIdTag);
            //redirect to home
            _this.nav.setRoot('page-hotel');
          }

          InitiateUploadUser(frameUploadUser); //passing mycallback as a method  
  }
 
}
