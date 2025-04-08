import React from 'react'
import axios from '@/api'
import { useLoaderData } from 'react-router'
export async function loader() {
    const testData = await axios.get('/test')
    return testData
}
const Home = () => {
    const testData = useLoaderData();
    console.log(testData);
  return (
    <div className=''>Home</div>
  )
}

export default Home