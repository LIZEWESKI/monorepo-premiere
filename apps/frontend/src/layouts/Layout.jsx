import React from 'react'
import {Outlet} from 'react-router'
const Layout = () => {
  return (
    <div className='flex flex-col gap-4 h-screen w-full min-h-screen'>
      <main className="flex flex-col flex-grow md:px-20 px-4 mt-14">
      <Outlet/>
      </main>
    </div>
  )
}

export default Layout