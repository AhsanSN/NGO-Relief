import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AccountPage } from './account';
import { AgmCoreModule } from '@agm/core';


@NgModule({
  declarations: [
    AccountPage
  ],
  imports: [
    IonicPageModule.forChild(AccountPage),
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCZi5b4jUyWZ-QMOt6azHzC4uSaD3VUSwM'
    })
  ],
  exports: [
    AccountPage
  ]
})

export class AccountPageModule { }
