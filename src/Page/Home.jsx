import { Link, Outlet, NavLink } from "react-router-dom"
import Page from "./Page"
import About from "./About"

export default function Home(){
    //let [searchParams, setSearchParams] = useSearchParams()
    //console.log(searchParams.get)


return(
<>

<h1>Home</h1>
<ul>
    {/* 
    <li><Link to= 'about'> About</Link></li>
    <li><Link to = 'page'> Page</Link></li>
    */}
    <li>
    <NavLink to ='/about'
    className={({ isActive }) => isActive ? 'active': ''}
    >
        About 
    </NavLink>
    </li>

    <li>
    <NavLink to ='/page'
    className={({ isActive }) => isActive ? 'active': ''}
    >
         Page
    </NavLink>
    </li>

</ul>
<Outlet />
</>
)

}