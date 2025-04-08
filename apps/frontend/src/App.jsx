import { RouterProvider,createBrowserRouter,createRoutesFromElements,Route } from 'react-router'
import Layout from './layouts/Layout'
import Home, {loader as homeLoader} from './pages/Home'
const App = () => {
  const router = createBrowserRouter(createRoutesFromElements(
    <Route path='/' element={<Layout/>}>
      <Route index element={<Home/>} loader={homeLoader} />
    </Route>
))
return (
  <RouterProvider router={router}/>
)
}

export default App
