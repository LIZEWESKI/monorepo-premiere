import React from 'react'
import {Outlet} from 'react-router'
const Layout = () => {
  return (
    <>
        <header>
            This is a header
        </header>
        <Outlet/>
        <footer>This is a footer</footer>
    </>
  )
}

export default Layout