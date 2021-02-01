@extends('layouts.app');


@section('content')
<br><br>
<div class="pull-right">
  <a href="home" title="Go back"><button class="btn btn-success">Back To Home</button> </a>
</div>
<br>
<div class="">
  <h1 style="text-align:center; color:black">Hierachical Displays in different hospital classifications</h1>
</div> 
<br>
<style>
    :root {
    --level-1: #8dccad;
    --level-2: #f5cc7f;
    --level-3: #7b9fe0;
    --level-4: #f27c8d;
    --black: black;
  }
  
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }
  
  ol {
    list-style: none;
  }
  
    .black{
        position:-webkit-sticky;
        top: 200px;
        padding: 0;
       margin: 0;
       box-sizing: border-box;
    }
    .tab{
        text-align: center;
        background:#000;
        color:#fff;
        border-radius: 999px;
        width: 100%;
        padding: 8px;
        font-weight: 800;
    }
    .tab-hospitals{
        text-align: center;
        background: green;
        color:white;
        border-radius: 99px;
        width: 100%;
        padding: 8px;
        font-weight: 800;
    }
    .contained {
    max-width: 1000px;
    padding: 0 10px;
    margin: 0 auto;
  }
  
  .rectangle {
    position: relative;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
  }
  
  
  
  /* LEVEL-3 STYLES
  –––––––––––––––––––––––––––––––––––––––––––––––––– */
  .level-3-wrapper {
    position: relative;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-column-gap: 20px;
    width: 90%;
    margin: 0 auto;
  }
  
  .level-3-wrapper::before {
    content: "";
    position: absolute;
    top: -20px;
    left: calc(25% - 5px);
    width: calc(50% + 10px);
    height: 2px;
    background: var(--black);
  }
  
  .level-3-wrapper > li::before {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%, -100%);
    width: 2px;
    height: 20px;
    background: var(--black);
  }
  
  .level-3 {
    margin-bottom: 20px;
    background: var(--level-3);
  }
  
  
  /* LEVEL-4 STYLES
  –––––––––––––––––––––––––––––––––––––––––––––––––– */
  .level-4-wrapper {
    position: relative;
    width: 80%;
    margin-left: auto;
  }
  
  .level-4-wrapper::before {
    content: "";
    position: absolute;
    top: -20px;
    left: -20px;
    width: 2px;
    height: calc(100% + 20px);
    background: var(--black);
  }
  
  .level-4-wrapper li + li {
    margin-top: 20px;
  }
  
  .level-4 {
    font-weight: normal;
    background: var(--level-4);
  }
  
  .level-4::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0%;
    transform: translate(-100%, -50%);
    width: 20px;
    height: 2px;
    background: var(--black);
  }
  
  
  /* MQ STYLES
  –––––––––––––––––––––––––––––––––––––––––––––––––– */
  @media screen and (max-width: 700px) {
    .rectangle {
      padding: 20px 10px;
    }
  
    .level-1,
    .level-2 {
      width: 100%;
    }
  
    .level-1 {
      margin-bottom: 20px;
    }
  
    .level-1::before,
    .level-2-wrapper > li::before {
      display: none;
    }
    
    .level-2-wrapper,
    .level-2-wrapper::after,
    .level-2::after {
      display: block;
    }
  
    .level-2-wrapper {
      width: 90%;
      margin-left: 10%;
    }
  
    .level-2-wrapper::before {
      left: -20px;
      width: 2px;
      height: calc(100% + 40px);
    }
  
    .level-2-wrapper > li:not(:first-child) {
      margin-top: 50px;
    }
  }
</style>
<div class="black"></div>
    <div class="container">
        <!-- <div class="col-md-12 mt-3 mb-3">
            <h1 class="tab">Hierachical Displays in different hospitals</h1>
        </div> -->
        <div class="contained">
            <div class="col-md-12 mt-3 mb-3">
                <h3 class="tab-hospitals">General Hospital Hierarchy</h3>
            </div>
            <ol>
                <h2 class="level-3 rectangle">Head General Hospital</h2>
                <ol class="level-4-wrapper">
                  <li>
                    <h4 class="level-4 rectangle">Covid-19 Health Officers</h4>
                  </li>
                </ol>
            </ol>
            <div class="col-md-12 mt-3 mb-3">
                <p class="tab-hospitals">Referal Hospital Hierarchy</p>
            </div>
            <ol>
                <h2 class="level-3 rectangle">Superintendent</h2>
                <ol class="level-4-wrapper">
                  <li>
                    <h4 class="level-4 rectangle">Senior Covid-19 Health Officers</h4>
                  </li>
                </ol>
                <div class="col-md-12 mt-3 mb-3">
                    <p class="tab-hospitals">National Hospital Hierarchy</p>
                </div>
                <ol>
                    <h2 class="level-3 rectangle">Director Covid19 Pandemic</h2>
                    <ol class="level-4-wrapper">
                      <li>
                        <h4 class="level-4 rectangle">Staff Members</h4>
                      </li>
                    </ol>

        </div>
    </div>
</div>'
    
@endsection