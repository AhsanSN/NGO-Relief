import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AgmCoreModule } from '@agm/core';
import { HomePage } from './home';

@NgModule({
  declarations: [
    HomePage
  ],
  imports: [
    IonicPageModule.forChild(HomePage),
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCZi5b4jUyWZ-QMOt6azHzC4uSaD3VUSwM'
    })
  ],
  exports: [
    HomePage
  ]
})

export class HomePageModule { }
