import React from 'react'
import axios from '@/api'
import { useLoaderData, Link } from 'react-router'
import TypographyH1 from '@/components/ui/TypographyH1'
import TypographyH2 from '@/components/ui/TypographyH2'
import TypographyP from '@/components/ui/TypographyP'
import TypographyBlockquote from '@/components/ui/TypographyBlockquote'
import { Button } from '@/components/ui/button'
export async function loader() {
    // const testData = await axios.get('/test')
    return null
}
const Home = () => {
    const testData = useLoaderData();
  return (
    <main className='flex flex-col items-center'>
      <div className='max-w-md text-center mb-12'>
        <TypographyH2 text="Epitaph is a place where there is nothing but complete void." />
        <TypographyP text="There is a saying that goes as follows: if you gaze long into an abyss, the abyss also gazes into you. But how about gazing long into the void? where there is nothing but emptiness. how could non-existing place gazes back into you?" />
        <TypographyBlockquote quote="All haunted souls remain on earth, they fail to go as they come. - Umami" />
      </div>
      <div>
        <Link to="/register">
          <Button size="lg" variant="outline">Write something cool. Sign up!</Button>
        </Link>
      </div>
      <div className='mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3'>
        <FeatureCard title="Create your Thoughts" description="You can create and archive your Thoughts."/>
        <FeatureCard title="Store Thoughts" description="Store your Thoughts securely with Epitaph."/>
        <FeatureCard title="Share your Thoughts" description="You can share your thoughts as card image with your friends(if you have any)."/>
      </div>
    </main>
  )
}
const FeatureCard = ({ title, description }) => {
  return (
    <div className="rounded-lg border border-border/50 bg-card/30 p-6 backdrop-blur transition-all hover:border-primary/50 hover:bg-card/50">
      <h3 className="mb-2 text-xl font-bold text-card-foreground">{title}</h3>
      <p className="text-muted-foreground">{description}</p>
    </div>
  )
}

export default Home