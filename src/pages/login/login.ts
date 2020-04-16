import {Component, OnInit} from "@angular/core";
import {FormGroup, Validators, FormBuilder} from '@angular/forms';
import {IonicPage, NavController, AlertController, ToastController, MenuController} from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";


@IonicPage({
  name: 'page-login',
  segment: 'login',
})

@Component({
  selector: 'page-login',
  templateUrl: 'login.html'
})
export class LoginPage implements OnInit {
  email = ""
  password = ""
  public onLoginForm: FormGroup;

  constructor(private _fb: FormBuilder, public nav: NavController, public forgotCtrl: AlertController, public menu: MenuController, public toastCtrl: ToastController,  private hotelService: HotelService) {

  }

  ngOnInit() {
    this.onLoginForm = this._fb.group({
      email: ['', Validators.compose([
        Validators.required
      ])],
      password: ['', Validators.compose([
        Validators.required
      ])]
    });
  }

  // go to register page
  register() {
    this.nav.setRoot('page-register');
  }

  // login and go to home page
  login(email, password) {
    //this.nav.setRoot('page-hotel');
    console.log("--", email, password)
    this.getUserFromServer(email, password);
  }


  getUserFromServer(email, password){
    var InitiateGetTransactions = function(email, password, callback) // How can I use this callback?
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
                 //console.log("no response for resturants") // Another callback here
             }
         }; 
         //console.log("sending _this.userIdTag to server", userIdTag)
         request.open("POST", "https://api.anomoz.com/api/ngo-relief/post/get_user.php?email="+email+"&password="+password);
         request.send();
     }
     
     var _this = this;
     var frameTransactions = function mycallback(data) {
       console.log("user data received from server," , data)
       var dataParsed
       dataParsed = JSON.parse(data);
       if(dataParsed.message=="none"){
         console.log("no user")
       }
       else{
        _this.hotelService.storeSignupData(dataParsed[0].name, email, password, dataParsed[0].userIdTag);
        _this.nav.setRoot('page-hotel');   
        //console.log(sampleTrans)
           
          	
          }
          //add to local storage
          //console.log("bookings storage updated", _this.bookings)
          //_this.storage.set('resturants', _this.hotels);
       }
     
     InitiateGetTransactions(email, password, frameTransactions); //passing mycallback as a method 
  }

}
