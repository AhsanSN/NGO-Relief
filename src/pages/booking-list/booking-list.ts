import {Component} from '@angular/core';
import {IonicPage, NavController, AlertController} from 'ionic-angular';
import {HotelService} from "../../providers/hotel-service";
import {HotelDetailPage} from "../hotel-detail/hotel-detail";
import { Storage } from '@ionic/storage';

@IonicPage({
  name: 'page-booking-list',
  segment: 'booking-list'
})

@Component({
    selector: 'page-booking-list',
    templateUrl: 'booking-list.html'
})
export class BookingListPage {

    bookings: any;

    constructor(public navCtrl: NavController, public storage: Storage,public service: HotelService, public alertCtrl: AlertController) {
      this.bookings = [];  
      this.bookings = this.service.getBookings();
        
        // console.log(this.favorites);
        /**
        this.bookings = [
            {
                resName: "Pearl Resturant",
                timeDine: "2 PM",
                timeBooked: "24th Sep, 18:20",
                nPeople: "3",
                totalBill: "3022",
                thumb: "assets/img/hotel/thumb/hotel_1.jpg"
            }
        ]
         */
    }

    itemTapped(booking) {
        this.navCtrl.push(HotelDetailPage, booking);
    }

    ionViewDidEnter() {
      console.log("didenter")
      this.service.getBookingsFromServer(this.service.userIdTag);
        // init map
        // this.initializeMap();
        var _this = this; 
        setTimeout(function(){
          _this.updateData1_4()
        }, 100);
    
        setTimeout(function(){
          _this.updateData1_4()
        }, 200);  
    
        setTimeout(function(){
          _this.updateData1_4()
        }, 300);
    
        setTimeout(function(){
          _this.updateData1_4()
        }, 500);
    
        setTimeout(function(){
              _this.updateData1_4()
        }, 900);
    
        setTimeout(function(){
          _this.updateData1_4()
        }, 1100);
    
      }

    ionViewDidLoad() {
      this.service.getBookingsFromServer(this.service.userIdTag);
        // init map
        // this.initializeMap();
        var _this = this; 
        setTimeout(function(){
          _this.updateData1_4()
        }, 100);
    
        setTimeout(function(){
          _this.updateData1_4()
        }, 200);  
    
        setTimeout(function(){
          _this.updateData1_4()
        }, 300);
    
        setTimeout(function(){
          _this.updateData1_4()
        }, 500);
    
        setTimeout(function(){
              _this.updateData1_4()
        }, 900);
    
        setTimeout(function(){
          _this.updateData1_4()
        }, 1100);

        var _this2 = this; 
        setInterval(function(){ _this2.fetchFromDB(); }, 3000);
    
      }
    
      updateData1_4(){
        //console.log("hotels data", this.hotels);
        
        this.bookings = this.service.getBookings();
        console.log("this.bookings", this.bookings);
        
      }

      openRatingBox(resId, cartId){
        console.log("openRatingBox")
        const alert = this.alertCtrl.create({
          //subTitle: "Rating your experience will help improve their services for everyone.",
          cssClass: 'alertstar',
          enableBackdropDismiss:false,
          buttons: [
               { text: ' ', handler: data => { this.doRating(resId, cartId, 1);}},
               { text: ' ', handler: data => { this.doRating(resId, cartId, 2);}},
               { text: ' ', handler: data => { this.doRating(resId, cartId, 3);}},
               { text: ' ', handler: data => { this.doRating(resId, cartId, 4);}},
               { text: ' ', handler: data => { this.doRating(resId, cartId, 5);}}
          ]
        });
        alert.present();
      }

      doRating(resId, cartId, rating){
        console.log("rating", cartId, rating, resId);
        this.bookings.forEach((val, i) => {
          if (val.cartId === cartId) {
            val.rating = rating
            console.log("rating changed")
            var ratingDetail = {
              cartId:cartId,
              rating:rating,
              resId: resId
            }
            this.uploadRatingToDatabase(ratingDetail)
          }
        });
      }

      uploadRatingToDatabase(aboutUser){
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
                          console.log("no respinse for rating") // Another callback here
                          //document.getElementById("noInternet").style.display = "block";
                      }
                  }; 
                  request.open("POST", "https://game.anomoz.com/api/allSet/post/insert_rating.php")
                  request.send(JSON.stringify(aboutUser));
              }
              var frameUploadUser = function mycallback(data) {
                console.log("user received from server," , data)
              }
    
              InitiateUploadUser(frameUploadUser); //passing mycallback as a method  
      }

      fetchFromDB(){
        console.log("fetchFromDB")
        this.service.getBookingsFromServer(this.service.userIdTag);
        ;
  
        if(JSON.stringify(this.bookings)!=JSON.stringify(this.service.getBookings())){
          //add to local storage
          console.log("diifrence found")
          this.bookings = this.service.getBookings();
        }
      }

      logout() {
        this.storage.set('userBasicInfo', null);
        this.navCtrl.setRoot('page-login');
      }



}
