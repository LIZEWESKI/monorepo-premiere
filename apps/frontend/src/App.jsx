import { RouterProvider,createBrowserRouter,createRoutesFromElements,Route } from 'react-router'
import Layout from './layouts/Layout'
import Home, {loader as homeLoader} from './pages/Home'
import About from './pages/About'
const App = () => {
  const router = createBrowserRouter(createRoutesFromElements(
    <Route path='/' element={<Layout/>}>
      <Route index element={<Home/>} loader={homeLoader} />
      <Route path='about' element={<About/>}/>
    </Route>
))
return (
  <RouterProvider router={router}/>
)
}

export default App
