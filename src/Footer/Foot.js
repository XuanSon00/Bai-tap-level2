import { Link, Outlet, NavLink } from "react-router-dom"


export default function Foot(){
    //let [searchParams, setSearchParams] = useSearchParams()
    //console.log(searchParams.get)


return(
<>
<nav className="footer bg-dark fixed-bottom">
  <div className="container">
    <div className="row justify-content-center align-items-center">
      <div className="col-sm-3 text-white">
        <h5>Thông tin liên hệ</h5>
        <ul>
          <li><i className='bx bx-map'></i> Ho Chi Minh City</li>
          <li><i className='bx bx-phone'></i> +84 90x xxx</li>
          <li><i className='bx bx-envelope'></i> abcd@gmail.com</li>
        </ul>
      </div>
      <div className="col-sm-3 text-white">
        <h5>Liên kết nhanh</h5>
        <ul className="text-white">
          <Link to="/"><li>&gt; Trang chủ</li></Link>
          <Link to="/gioi-thieu"><li>&gt; Giới thiệu</li></Link>
          <Link to="/san-pham"><li>&gt; Sản phẩm</li></Link>
          <Link to="/blog"><li>&gt; Blog</li></Link>
          <Link to="/lien-he"><li>&gt; Liên hệ</li></Link>
        </ul>
      </div>
      <div className="col-sm-3 text-white">
        <h5>Thông tin chính sách</h5>
        <ul className="text-white">
          <Link to="/thanh-toan"><li>&gt; Thanh toán</li></Link>
          <Link to="/doi-tra"><li>&gt; Hình thức Đổi trả</li></Link>
          <Link to="/van-chuyen"><li>&gt; Vận chuyển & Delivery</li></Link>
          <Link to="/chinh-sach"><li>&gt; Chính sách</li></Link>
          <Link to="/dieu-khoan"><li>&gt; Điều khoản và Điều kiện</li></Link>
        </ul>
      </div>
      <div className="col-sm-3 text-white">
        <h5>Liên hệ với chúng tôi</h5>
        <div style={{ paddingLeft: '10px', margin: '50px' }}>
          <a href="#"><i className='bx bxl-facebook-circle icon' style={{ backgroundColor: '#3b5998', border: '2px solid black', borderRadius: '50%', color: 'white', padding: '5px', textDecoration: 'none', color: 'inherit' }}></i></a>
          <a href="#"><i className='bx bxl-twitter icon' style={{ backgroundColor: '#00acee', border: '2px solid black', borderRadius: '50%', color: 'white', padding: '5px', textDecoration: 'none', color: 'inherit' }}></i></a>
          <a href="#"><i className='bx bxl-google icon' style={{ backgroundColor: '#c71610', border: '2px solid black', borderRadius: '50%', color: 'white', padding: '5px', textDecoration: 'none', color: 'inherit' }}></i></a>
          <a href="#"><i className='bx bxl-instagram icon' style={{ background: 'linear-gradient(to top, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5)', border: '2px solid black', borderRadius: '50%', color: 'white', padding: '5px', textDecoration: 'none', color: 'inherit' }}></i></a>
        </div>
      </div>
    </div>
  </div>
</nav>
<Outlet />
</>
)

}