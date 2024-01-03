export function increase(){
    //console.log(1)
    return { 
        type: 'INCREMENT', //action type
        //payload: {
            count: 1
       // } //payload information
     }
     
}

export function decrease(){
    //console.log(1)
    return { 
        type: 'DECREMENT', //action type
        //payload: {
            count: 1
       // } //payload information
     }
     
}


