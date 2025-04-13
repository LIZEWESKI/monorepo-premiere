import { Github } from 'lucide-react'
import React from 'react'
import { Button } from './ui/button'
import AppLogo from './AppLogo'
const Footer = () => {
  return (
    <footer className='flex justify-between items-center bg-card/10 border-t-[1px] border-border px-12 p-2'>
      <div className='flex justify-between items-center gap-2'>
        <AppLogo />
        <p className="text-sm text-muted-foreground">Epitaph all rights reserved.</p>
      </div>
      <div>
        <Button variant="ghost">
          <Github/>
        </Button>
      </div>
    </footer>
  )
}

export default Footer