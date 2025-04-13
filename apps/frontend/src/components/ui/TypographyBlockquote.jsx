import React from 'react'

const TypographyBlockquote = ({quote}) => {
  return (
    <blockquote className="mt-6 border-l-2 pl-6 italic text-muted-foreground">
      "{quote}"
    </blockquote>
  )
}

export default TypographyBlockquote