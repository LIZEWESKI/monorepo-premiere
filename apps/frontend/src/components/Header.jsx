import React from 'react'
import AppLogo from './AppLogo'
import { Link, NavLink } from 'react-router'
import { Button } from '@/components/ui/button'
const Header = () => {
    const navigation = [
        {url: "/notes", name: "Notes"},
        {url: "/note/create", name: "Create Note"},
        {url: "/about", name: "About"}
    ]
  return (
    <header className='flex justify-between px-12 items-center py-2 border-border border-b-[1px] '>
        <div className='flex justify-between items-center gap-6'>
            <div className='flex items-center gap-2'>
                <AppLogo />
                <Link to="/" className='text-xl font-extrabold'>Epitaph</Link>
            </div>
            <nav className='flex items-center gap-6'>
                {navigation.map(link => (
                    <li className='text-muted-foreground text-sm hover:text-primary' key={link.name}>
                        <NavLink 
                        to={link.url} 
                        className={({isActive}) => isActive ? "text-primary" : ""}
                        >
                        {link.name}</NavLink>
                    </li>
                ))}
            </nav>
        </div>
        <div className='flex items-center gap-4'>
            <Link to="/login">
                <Button
                variant="outline" 
                >
                    Log in
                </Button>
            </Link>
            <Link to="/register">
                <Button>Sign up</Button>
            </Link>
        </div>
    </header>
  )
}

export default Header