import { connect } from "react-redux";


/*
ben trong component sẽ xử lý nội dung sau:
import component dùng để render
import action đã tạo
sử dụng mapeStateToProps để truyền state => component
sử dụng mapDispatchToProps  để truyền action 
sử dụng connect(mapStateToProps, mapDispatchToProps)(Conter)
*/ 
import Counter2 from "./Counter2";
//component Counter
//Sử dụng sự kiện click để thay đổi state có thuộc tính isLoading

//import { increment, decrement, reset } from '../action';
import decrease  from '../Action/index3'

//sử dụng mapStateToPops để truyền state => component
const mapStateToProps = (state) => {
    return {
        counter: state
    };
};
//Sử dụng mapDispatchToProps để truyền action 
const mapDispatchToProps = (dispatch) => {
    return {
        //increment: () => dispatch(increment()),
        //decrement: () => dispatch(decrement()),
        //reset: () => dispatch(reset()),
        decrease: () => dispatch(decrease())
    };
}

export default connect(mapStateToProps, mapDispatchToProps)(Counter2)