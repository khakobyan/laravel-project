import React, { Component } from 'react'
import Nav from './navbar'


export default class Index extends Component {

  render() {
    return (
      <div> 
        <Nav />       
        <div className="container text-center  title">
          <h1>Laravel + React 	Basic Authentication </h1>
        </div> 
      </div>   
    )
  }
}
