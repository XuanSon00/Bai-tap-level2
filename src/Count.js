import React, { useState } from 'react';

const Counter = ({ count }) => {
  return <div>Số lần click: {count}</div>;
};

const Button = () => {
  const [count, setCount] = useState(0);

  const handleClick = () => {
    setCount(count + 1);
  };

  return <button onClick={handleClick}>Click vào đây</button>;
};

export { Counter, Button };

