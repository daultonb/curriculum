@extends('layouts.app')

@section('content')

<link href=" {{ asset('css/accordions.css') }}" rel="stylesheet" type="text/css" >
<!--Link for FontAwesome Font for the arrows for the accordions.-->
<link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" rel="stylesheet" type="text/css" >


<div class="container">
    <div class="row">
        <div style="width: 100%;border-bottom: 1px solid #DCDCDC">
            <h1 style="text-align:center;">FAQ</h1>
        </div>
        
        <div class="accordions" style="width:100%">
            <div class="accordion" id="accordionGroup">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <input class="accordion-input" type="checkbox" id="title1" data-toggle="collapse" data-target="#collapseOne"/>
                        <label for="title1">
                            <h3 class="accordion-title">Can I use this mapping website if I don’t have all course details?</h3>
                        </label>   
                    </div>        
                </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionGroup">
                        <div class="card-body">    
                            <p class="lead">Yes, the minimum requirement to use this tool is a set of course learning outcomes or competencies. All other requested information is optional.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <input class="accordion-input" type="checkbox" id="title2" data-toggle="collapse" data-target="#collapseTwo"/>
                        <label for="title2">
                            <h3 class="accordion-title">Can I view how different courses map to different program learning outcomes?</h3>                   
                        </label>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionGroup">
                        <div class="card-body">
                            <p class="lead">Yes, you may map one course to as many sets of program-learning outcomes or competencies as you like.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <input class="accordion-input" type="checkbox" id="title3" data-toggle="collapse" data-target="#collapseThree"/>
                        <label for="title3">
                            <h3 class="accordion-title">How do I retrieve a course or program that I deleted in the past? </h3>
                        </label>                   
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionGroup">
                        <div class="card-body">
                            <p class="lead">Once you have deleted a course or a program, you are not able to retrieve it.</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <input class="accordion-input" type="checkbox" id="title4" data-toggle="collapse" data-target="#collapseFour"/>
                        <label for="title4">
                            <h3 class="accordion-title">Can somebody help me use this tool? </h3>
                        </label>                 
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionGroup">
                        <div class="card-body">
                            <p class="lead">Yes, you may request support for course and program mapping from the Centre for Teaching and Learning or the Provost Office.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End here -->
@endsection
