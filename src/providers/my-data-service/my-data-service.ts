import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Storage } from '@ionic/storage';

/*
  Generated class for the MyDataServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class MyDataServiceProvider {
  public name;
  public userIdTag; 
  public email;
  public password;

  constructor(public http: HttpClient, public storage: Storage) {
    console.log('Hello MyDataServiceProvider Provider');
    this.getDataFromStorageOnLogin()
  }


  getDataFromStorageOnLogin(){
    this.storage.get('userBasicInfo').then((val) => {

      if (val===null){
        console.log("no data found. Error!!!", val);
      }
      else{
        this.name = val.name;
        this.email = val.email;
        this.password = val.password;
        this.userIdTag = val.userIdTag;
      
        console.log("some data found", val);
        this.setDataOnLogin(this.name, this.email, this.password, this.userIdTag, 0)        
      }
    }); 
  }

  
  setDataOnLogin(name, email, password, userIdTag, storeLocal){
    
    this.name = name;
    this.email = email;
    this.password = password;
    this.userIdTag = userIdTag;


    if(storeLocal ==1){
      var tempInfo = {
        "name": this.name,
        "email": this.email,
        "password": this.password,
        "userIdTag": this.userIdTag,
      }
      // set a key/value
      console.log("storage updated to:", tempInfo);
      this.storage.set('userBasicInfo', tempInfo);
    }
  }

  storeSignupData(name, email, password, userIdTag){
    this.name = name;
    this.email = email;
    this.password = password;
    this.userIdTag = userIdTag;

    var tempInfo = {
      "name": this.name,
      "email": this.email,
      "password": this.password,
      "userIdTag": this.userIdTag    
    }
    // set a key/value
    console.log("storage updated to (signup):", tempInfo);
    this.storage.set('userBasicInfo', tempInfo);
  }
  
}
