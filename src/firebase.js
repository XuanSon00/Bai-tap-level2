import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore";

// TODO: Replace the following with your app's Firebase project configuration
// See: https://support.google.com/firebase/answer/7015592
/*const firebaseConfig = {
  apiKey: "AIzaSyCCZ1DyzRRumcgJCGqEq8Q77ZGijIh1jXQ",
  authDomain: "todolist-react-firebase-db2f8.firebaseapp.com",
  projectId: "todolist-react-firebase-db2f8",
  storageBucket: "todolist-react-firebase-db2f8.appspot.com",
  messagingSenderId: "51653278156",
  appId: "1:51653278156:web:da52ac932559163fd64569"
};*/ //TodoList
const firebaseConfig = {
  apiKey: "AIzaSyD8G36Oujm4kSdKc8tXRiB4M0XPxeG4Ops",
  authDomain: "vote-reactjs-firebase-6554d.firebaseapp.com",
  projectId: "vote-reactjs-firebase-6554d",
  storageBucket: "vote-reactjs-firebase-6554d.appspot.com",
  messagingSenderId: "599689213035",
  appId: "1:599689213035:web:a65163cd11cf11cf5fad2e"
};
// Initialize Firebase
const app = initializeApp(firebaseConfig);


// Initialize Cloud Firestore and get a reference to the service
export const db = getFirestore(app);
