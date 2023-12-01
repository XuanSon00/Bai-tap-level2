import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore";

// TODO: Replace the following with your app's Firebase project configuration
// See: https://support.google.com/firebase/answer/7015592
const firebaseConfig = {
  apiKey: "AIzaSyCCZ1DyzRRumcgJCGqEq8Q77ZGijIh1jXQ",
  authDomain: "todolist-react-firebase-db2f8.firebaseapp.com",
  projectId: "todolist-react-firebase-db2f8",
  storageBucket: "todolist-react-firebase-db2f8.appspot.com",
  messagingSenderId: "51653278156",
  appId: "1:51653278156:web:da52ac932559163fd64569"
};
// Initialize Firebase
const app = initializeApp(firebaseConfig);


// Initialize Cloud Firestore and get a reference to the service
export const db = getFirestore(app);
