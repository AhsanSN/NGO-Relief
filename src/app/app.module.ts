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
import {ionBookingApp} from "./app.component";
import { MyDataServiceProvider } from '../providers/my-data-service/my-data-service';
//import { HotelPage } from "../pages/hotel/hotel";
import { HomePage } from "../pages/home/home";

//import { BookingListPage } from '../pages/booking-list/booking-list';


//import { HotelPageModule } from '../pages/hotel/hotel.module';
import { IonicImageLoader } from 'ionic-image-loader';
import { Device } from '@ionic-native/device';
import { HomePageModule } from "../pages/home/home.module";

import { Camera } from '@ionic-native/camera';
import { File } from '@ionic-native/file';
import { FilePath } from '@ionic-native/file-path/ngx';


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
    HomePageModule,
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
    //HotelPage,
    HomePage,
    //BookingListPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    Keyboard,
    HotelService,
    Device,
    { provide: ErrorHandler, useClass: IonicErrorHandler },
    MyDataServiceProvider,
    HttpModule,
    FileTransfer,
    Geolocation,
    Camera,
    File,
    FilePath    
    ]
})

export class AppModule {
}
