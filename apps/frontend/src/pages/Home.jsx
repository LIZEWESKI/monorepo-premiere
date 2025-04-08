import React from 'react'
import axios from '@/api'
import { useLoaderData } from 'react-router'
export async function loader() {
    const data = await axios.get('/post')
    // const data = await res.json()
    return data
}
const Home = () => {
    const data = useLoaderData();
    console.log(data);
  return (
    <div>Home</div>
  )
}

export default Home