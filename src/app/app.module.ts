import {ErrorHandler, NgModule} from "@angular/core";
import {IonicApp, IonicErrorHandler, IonicModule} from "ionic-angular";
import {BrowserModule} from '@angular/platform-browser';
import {HttpClientModule} from '@angular/common/http';
import {IonicStorageModule} from '@ionic/storage';
import {CalendarModule} from "ion2-calendar";
import {FileTransfer} from '@ionic-native/file-transfer';
//import {File} from '@ionic-native/File/ngx';
import {Geolocation} from '@ionic-native/geolocation';
import {HttpModule} from '@angular/http';
import {AgmCoreModule} from '@agm/core';


import {StatusBar} from '@ionic-native/status-bar';
import {SplashScreen} from '@ionic-native/splash-screen';
import {Keyboard} from '@ionic-native/keyboard';

import {HotelService} from "../providers/hotel-service";
//import {PlaceService} from "../providers/place-service";
//import {ActivityService} from "../providers/activity-service";
//import {CarService} from "../providers/car-service";
//import {TripService} from "../providers/trip-service";
//import {WeatherProvider} from '../providers/weather';
//import {MessageService} from '../providers/message-service-mock';
import { FavoriteListPage } from '../pages/favorite-list/favorite-list';

import {ionBookingApp} from "./app.component";
import { MyDataServiceProvider } from '../providers/my-data-service/my-data-service';
import { HotelPage } from "../pages/hotel/hotel";
//import { BookingListPage } from '../pages/booking-list/booking-list';


import { HotelPageModule } from '../pages/hotel/hotel.module';
import { FavoriteListPageModule } from '../pages/favorite-list/favorite-list.module';

import { IonicImageLoader } from 'ionic-image-loader';
import { Device } from '@ionic-native/device';

@NgModule({
  declarations: [
    ionBookingApp,
    //FavoriteListPage,
    //HotelPage,
    //BookingListPage
  ],
  imports: [
    //HotelPage,
    //FavoriteListPage,
    HotelPageModule,
    FavoriteListPageModule,
    BrowserModule,
    HttpClientModule,
    IonicModule.forRoot(
      ionBookingApp,
      {
        preloadModules: true,
        scrollPadding: false,
        scrollAssist: true,
        autoFocusAssist: false
      }
    ),
    IonicStorageModule.forRoot(),
    IonicImageLoader.forRoot(),
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCZi5b4jUyWZ-QMOt6azHzC4uSaD3VUSwM'
    }),
    CalendarModule
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    ionBookingApp,
    FavoriteListPage,
    HotelPage,
    //BookingListPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    Keyboard,
    HotelService,
    Device,
    //PlaceService,
    //ActivityService,
    //CarService,
    //TripService,
    //CarService,
    //TripService,
    //MessageService,
    //WeatherProvider,
    { provide: ErrorHandler, useClass: IonicErrorHandler },
    MyDataServiceProvider,
    HttpModule,
    FileTransfer,
    Geolocation
    
    ]
})

export class AppModule {
}
