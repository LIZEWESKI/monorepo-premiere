import Footer from '@/components/Footer'
import Header from '@/components/Header'
import React from 'react'
import {Outlet} from 'react-router'
const Layout = () => {
  return (
    <div className='flex flex-col h-screen w-full min-h-screen '>
        <Header/>
        <main className='flex flex-col flex-grow px-20 py-6'>
          <Outlet/>
        </main>
        <Footer/>
      </div>
  )
}

export default Layout