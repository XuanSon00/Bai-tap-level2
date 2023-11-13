import { Link, Outlet, NavLink } from "react-router-dom"
import Phone from "./Phone"
import Tablet from "./Tablet"
import Error from "./Error"

export default function Home(){
    //let [searchParams, setSearchParams] = useSearchParams()
    //console.log(searchParams.get)


return(
<>

<section>
      <nav className="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div className="container-fluid ">
          <Link className="navbar-brand text-white " to="/homepage">
            <i style={{ fontSize: '50px' }} className="bx bxl-apple"></i>
          </Link>
          <button
            className="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span className="navbar-toggler-icon"></span>
          </button>
          <div className="collapse navbar-collapse" id="navbarSupportedContent">
            <ul className="navbar-nav me-auto mb-2 mb-lg-0">
              <li className="nav-item dropdown text-dark">
                <Link
                  className="nav-link dropdown-toggle text-light "
                  to="/"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  
                >
                  Loại Sản Phẩm
                </Link>
                <ul className="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                  <li>
                    <Link className="dropdown-item text-light" to="/Phone">
                      Điện Thoại
                    </Link>
                  </li>
                  <li>
                    <Link className="dropdown-item text-light" to="/Tablet">
                      Tablet
                    </Link>
                  </li>
                </ul>
              </li>

              

              <li className="nav-item dropdown">
                <Link
                  className="nav-link dropdown-toggle text-light"
                  to="/"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Quản Lý
                </Link>
                <ul className="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                  <li>
                    <Link className="dropdown-item text-light condition" to="/Manager">
                      Người dùng
                    </Link>
                  </li>
                  <li>
                    <Link className="dropdown-item text-light condition" to="/manageProduct">
                      Sản Phẩm
                    </Link>
                  </li>
                </ul>
              </li>


            </ul>
            <form className="d-flex">
            <div className="d-flex Log">
                <Link className="nav-link text-white logIn-SignIn" to="/index">
                  Đăng Nhập
                </Link>
                <Link className="nav-link text-white logIn-SignIn" to="/index">
                  Đăng Ký
                </Link>
            </div>
              <Link className="nav-link text-white condition " to="/cart">
                <i style={{ fontSize: '50px' }} className="bx bx-cart-alt">
                  <sub style={{ fontSize: 'medium', color: '#e5330b' }} id="total">
                    0
                  </sub>
                </i>
              </Link>
              <input className="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search" />
              <button className="btn btn-outline-success" type="submit">
                Search
              </button>
            </form>
          </div>
        </div>
      </nav>
    </section>



<Outlet />
</>
)

}