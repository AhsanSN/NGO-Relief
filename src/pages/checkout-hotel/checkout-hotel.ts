import {Component} from "@angular/core";
import {IonicPage, NavController, NavParams, LoadingController, ToastController, ActionSheetController, AlertController } from "ionic-angular";
import {HotelService} from "../../providers/hotel-service";

declare var Stripe;

@IonicPage({
  name: 'page-checkout-hotel',
  segment: 'checkout-hotel/:id'
})


@Component({
  selector: 'page-checkout-hotel',
  templateUrl: 'checkout-hotel.html'
})
export class CheckoutHotelPage {
  param: number;
  // hotel info
  public hotel: any;

  public dateTo = new Date();
  public subTotal = 0; 
  public tax = 0;
  public total = 0;
  public nPeople;
  public time: string;
  public cartToServer: any;

  public paymethods = 'creditcard';
  cardinfo: any = {
    number: '',
    expMonth: '',
    expYear: '',
    cvc: ''
  }

  constructor(public nav: NavController, public hotelService: HotelService, public navParams: NavParams, public loadingCtrl: LoadingController, public toastCtrl: ToastController, public actionSheetController: ActionSheetController, private alertCtrl: AlertController) {
     
    this.hotel = this.hotelService.getCartItems();
    this.nPeople = this.hotel.nPeople;
    this.nPeople = this.hotelService.nPeopleBooking
    this.time = "1:00 AM"

    /**
    this.hotel = [
      {
        itemId: 12,
        itemName: "pizza",
        itemQuantity: 2,
        itemPrice: 500,
      },
      {
        itemId: 13,
        itemName: "Burger",
        itemQuantity: 1,
        itemPrice: 300,
      }
    ]
     */
     
       
    //subtotal
    this.hotel.forEach((val, i) => {
      this.subTotal+= (val.itemPrice*val.itemQuantity)
    });

    this.subTotal = Math.round(this.subTotal)
    this.tax = Math.round((12*this.subTotal)/100)
    this.total =  Math.round(this.subTotal+this.tax)

    console.log("subtotal, tax, total", this.subTotal, this.tax, this.total)

  
  
  
  }

  changeNPeople(){
    console.log("changeNPeople called")
    this.presentActionSheetForNPeople()
  }

  async presentActionSheetForNPeople() {
    const actionSheet = await this.actionSheetController.create({
      buttons: [{
        text: '2',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("2");
        }
      }, {
        text: '3',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("3");
        }
      },
      {
        text: '5+',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("5+");
        }
      },
      {
        text: '8+',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("8+");
        }
      },
      {
        text: '10+',
        role: 'destructive',
        icon: 'people',
        handler: () => {
          this.changeNPeopleMain("10+");
        }
      },
       {
        text: 'Cancel',
        icon: 'close',
        role: 'cancel',
        handler: () => {
          console.log('Cancel clicked');
        }
      }]
    });
    await actionSheet.present();
  }

  addTime(){
    console.log("addtime called")
    //this.presentActionSheetForTime()
    let alert = this.alertCtrl.create({
      title: 'Enter Time',
      inputs: [
        {
          name: 'time',
          placeholder: 'time',
          type: 'time'
        }
      ],
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel',
          handler: data => {
            console.log('Cancel clicked');
          }
        },
        {
          text: 'Save',
          handler: data => {
            console.log("data", data.time);
            this.setTime(data.time)
            /** 
            if (User.isValid(data.username, data.password)) {
              // logged in!
            } else {
              // invalid login
              return false;
            }
            */
          }
        }
      ]
    });
    alert.present();
  }

  

  // process send button
  send() {
    // send booking info
    let loader = this.loadingCtrl.create({
      content: "Please wait..."
    });
    // show message
    let toast = this.toastCtrl.create({
      showCloseButton: true,
      cssClass: 'profile-bg',
      message: 'Booking Success!',
      duration: 3000,
      position: 'bottom'
    });

    loader.present();

    this.hotelService.bookings(this.hotel)
        .then(response => {
          setTimeout(() => {
            loader.dismiss();
            toast.present();
            // back to home page
            this.nav.setRoot('page-home');
          }, 3000)
        });
        
  }

  changeNPeopleMain(nPeople){
    console.log("changeNPeopleMain called")
    this.nPeople = nPeople
    this.hotelService.setNPeople(nPeople);
  }

  setTime(time){
    this.time = this.tConvert(time);
  }

  tConvert (time) {
    // Check correct time format and split into components
    time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
 
     if (time.length > 1) { // If time format correct
       time = time.slice (1);  // Remove full string match value
       time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
       time[0] = +time[0] % 12 || 12; // Adjust hours
     }
     return time.join (''); // return adjusted time or original string
   }

   uploadBookingToServer(){
    var cart = this.hotel;
    var d = new Date();
    var cartId = ((d.getTime()).toString()+this.hotelService.resturantId.toString()+this.hotelService.nPeopleBooking.toString());
    var timeAdded = (d.getTime())
    this.cartToServer = []
    cart.forEach((val, i) => {
      var cartEntry = {
        "itemId": val.itemId,
        "cartId": cartId,
        "quantity": val.itemQuantity,
        "timeAdded": timeAdded,
        "timeDue": this.time,
        "nPeople": this.nPeople,
        "userIdTag":this.hotelService.userIdTag,
        "resId": this.hotelService.resturantId
      }
      this.cartToServer.push(cartEntry);
    });

    console.log("cartToServer", this.cartToServer)

    var justItems = [];
    this.cartToServer.forEach(element => {
      justItems.push(element.itemId)
    });
    var justItemsStr = justItems.toString()
    justItemsStr = "["+justItemsStr+"]"
    console.log("justItems", justItemsStr)
    this.checkIfItemsAvailable(justItemsStr);
    
   
  }

  headToBookings(){
    // show message
    let toast = this.toastCtrl.create({
      showCloseButton: true,
      cssClass: 'profile-bg',
      message: 'Booking Successfull!',
      duration: 600,
      position: 'bottom'
    });

    setTimeout(() => {
      toast.present();
      // back to home page
      //this.nav.setRoot('page-home');
      this.nav.setRoot('page-booking-list');
      //this.nav.pop();
    }, 50)

  }

  uploadBookingToDatabase(aboutUser){
        var _this3 = this;
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
                      console.log("no respinse for booking") // Another callback here
                  }
              }; 
              request.open("POST", "https://api.anomoz.com/api/allSet/post/insert_booking.php")
              request.send(JSON.stringify(aboutUser));
          }
          //var _this = this;
          var frameUploadUser = function mycallback(data) {
            console.log("response from server when booking," , data)
            //window.open('https://projects.anomoz.com/allSet/bookingSuccessfull.php?resturantId='+_this3.hotelService.resturantId)
            _this3.sendNotfToResTurants()
            _this3.headToBookings()
          }

          InitiateUploadUser(frameUploadUser); //passing mycallback as a method  
  }

  payWithStripe(){
    console.log(" payWithStripe called")
    Stripe.setPublishableKey("pk_test_sdFgZctlpNxecLEyh2olufL60069lDve4C");
    let card = {
      number: '4242424242424242',
      expMonth: 10,
      expYear: 2019,
      cvc: '235'
     }

      try {
        Stripe.card.createToken(card, (status, response) => 
        {
          console.log("responseMine", status, response)
          var token = response.id
          //var token = response.token
          //var data = 'stripetoken=' + token + '&amount=50';
          /**
          var headers = new Headers();
          headers.append('Conent-Type', 'application/x-www-form-urlencoded');
          this.http.post('https://game.anomoz.com/api/allSet/post/insert_booking.php', data, { headers: headers }).subscribe((res) => {
            console.log("myserver response", res)
            /**
            if (res.json().success)
            alert('transaction Successfull!!')
             
          })
          */
        })
      }
      catch (e) {
        console.log("submitPayment - inner", e);
      }

  }

  removeItem(itemId){
    console.log("rem item", itemId)
    this.hotelService.removeItemFromCart(itemId)
    this.hotel = this.hotelService.getCartItems();
    this.hotel.forEach((val, i) => {
      this.subTotal+= (val.itemPrice*val.itemQuantity)
    });

    //calculations
    this.subTotal = 0
    //subtotal
    this.hotel.forEach((val, i) => {
      this.subTotal+= (val.itemPrice*val.itemQuantity)
    });
    this.subTotal = Math.round(this.subTotal)
    this.tax = Math.round((12*this.subTotal)/100)
    this.total =  Math.round(this.subTotal+this.tax)

    console.log("subtotal, tax, total", this.subTotal, this.tax, this.total)

  }

  checkIfItemsAvailable(allItems){
    var _this5 = this;
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
                  console.log("no respinse for booking") // Another callback here
              }
          }; 
          request.open("POST", "https://api.anomoz.com/api/allSet/post/verfiyMenuItems.php?items="+allItems)
          request.send();
      }
      //var _this = this;
      var frameUploadUser = function mycallback(data) {
        var dataParsed = JSON.parse(data);
        console.log("dataParsed", dataParsed, _this5.cartToServer)
        if(dataParsed.message=="ok"){
          //console.log("no bookings")
          _this5.uploadBookingToDatabase(_this5.cartToServer)
        }
        else{
          //error occured
          let toast = _this5.toastCtrl.create({
            showCloseButton: true,
            cssClass: 'refresh-bgg',
            message: 'Error occured',
            duration: 3000,
            position: 'top'
          });
      
          toast.present();

        }

      }

      InitiateUploadUser(frameUploadUser); //passing mycallback as a method  
  }

  

  sendNotfToResTurants(){
    var _this5 = this;
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
                  console.log("no respinse for booking") // Another callback here
              }
          }; 
          request.open("POST", "https://api.anomoz.com/api/allSet/post/sendNofttoRes.php?vendorId="+_this5.hotelService.resturantId)
          request.send();
      }
      //var _this = this;
      var frameUploadUser = function mycallback(data) {
        //console.log("response from server when sending notf," , data)
        //window.open('https://projects.anomoz.com/allSet/bookingSuccessfull.php?resturantId='+_this3.hotelService.resturantId)
      }

      InitiateUploadUser(frameUploadUser); //passing mycallback as a method  
}
}
