import { configureStore } from "@reduxjs/toolkit";
import counterReducer from '../reducers/index3'

export default configureStore({
    reducer:{
        counter: counterReducer,
    },
})