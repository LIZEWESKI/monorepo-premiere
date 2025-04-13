import React from 'react'

const TypographyP = ({text}) => {
  return (
    <p className="leading-7 [&:not(:first-child)]:mt-6 text-muted-foreground">
      {text}
    </p>
  )
}

export default TypographyP