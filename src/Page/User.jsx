import { useSearchParams, useParams } from "react-router-dom";
export default function User(){
    //let [searchParams, setSearchParams] = useSearchParams()
    //console.log(searchParams.get)

    let { userId }  = useParams();
return <h1>User page: {userId}</h1>
}