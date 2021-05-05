@extends('layouts.app')

@section('content')
    <!-- <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="jumbotron">
                <h1 class="display-4">UBCO Curriculum MAP</h1>
                <p class="lead">Course and program planning platform at UBCO</p>
                <hr class="my-4">
                <p>Plan, review and align courses and programs using online curriculum mapping tool. </p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </p>
            </div>
        </div>
    </div> -->

    <!-- <div class="row mb-5 mt-3 justify-content-center font-weight-bold text-primary">
        <div class="col-md-8">
            <h1><strong>What is Curriculum Mapping ?</strong></h1>
            <p>
                It is “the process of associating course outcomes with program‐level learning outcomes and aligning elements of courses
                (e.g., teaching and learning activities, assessment strategies) within a program, to ensure that it is structured in a
                strategic, thoughtful way that enhances student learning.” (Dyjur & Kalu, 2017). In other words, mapping provides a global view of how
                elements of the curriculum relate to the program outcomes.
            </p>

        </div>
    </div> -->

    <div class="row p-md-5 justify-content-center text-dark bg-secondary">
        <div class="col-md-12 ">
            <div class="container">
                <p><strong>UBC</strong></p>
                    <h1>Curriculum MAP</h1>                                                  
                    <p class="lead">A tool to support currculum mapping, analysis, and planning.</p>
            </div>
        </div>
    </div>

    <div class="row p-md-5 justify-content-center text-light bg-primary">
        <div class="col-md-12">
            <div class="container">
                <h1>What is Curriculum Mapping?</h1>
                <p>
                    Curriculum mapping is an instrument to evaluate the alignment of learning objectives to academic strategies at educational institutions.
                </p>
                <div class="row">
                    <div class="col-sm"> 
                        <div class="img">
                            <!-- replace this with ideation img!! -->
                            <img src=" {{ asset('img/Ideation.png') }}"/>
                        </div>
                        <h4>Ideation</h4>
                        <p>Allows instructors to map program learning outcomes (PLOs) to course learning outcomes (CLOs) of required and non-required courses for the program.</p>
                    </div>
                    <div class="col-sm">
                
                        <div class="img"> 
                            <!-- replace this with creation img!! -->
                            <img src=" {{ asset('img/Creation.png') }}"/>
                        </div>
                        <h4>Creation</h4>
                        <p>Allows instructors to create a new course by identifying course learning outcomes, assessment strategies, and teaching and learning methods.</p>
                    </div>
                    <div class="col-sm">
                        <div class="img">
                            <!-- replace this with evaulation img!! -->
                            <img src=" {{ asset('img/Evaluation.png') }}"/>
                        </div>
                        <h4>Evaluation</h4>
                        <p>Allows instructors to evaluate existing courses or programs by looking at the alignment across learning outcomes, assessment methods, and teaching and learning activities.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-md-5 justify-content-center text-dark bg-secondary">
        <div class="container">
            <div class="quote">
                <h4><strong>
                “make learning and teaching more <br>meaningful to students and teachers” 
                </strong></h4>
                <p class="lead">
                Lam and Tsui, 2016
                </p>
            </div>
            <div class="span4">
                <div class="text-center clearfix">
                        <!-- Image recoloured from: https://www.flaticon.com/free-icon/conversation-mark-interface-symbol-of-circular-speech-bubble-with-quotes-signs-inside_40341 -->
                        <img src=" {{ asset('img/Quote4_blue2.png') }}"/>
                    <div style="display:inline-block">
                        <h4><strong>
                        “develop, review, improve <br>and perfect an integrated <br>curriculum, including <br>curriculum alignment”
                        </strong></h4>
                        <p class="lead">
                        Khoerunnisa et al, 2018
                        </p>
                    </div>
                </div>  
            </div>

            <div class="quote">
                <h4><strong>
                    “understand curriculum structures and relationships, gain <br>insight in how students experience their discipline, and <br>increase awareness of curricular content” 
                </strong></h4>
                <p class="lead">
                    Archambault and Masunaga, 2015
                </p>
            </div>
        </div>
    </div>

    
    <div class="row p-md-2 justify-content-center text-light bg-primary">
        <div class="container">
                <div class="col-md font-weight-bold">

                &nbsp;&nbsp;
                
                </div>
        </div>
    </div>

    <div class="row p-md-5 justify-content-center text-dark bg-secondary">
        <div class="container">
            <h1>Benefits</h1>
            <div class="row pb-sm-5">
                <div class="col-sm">
                    <!-- replace this with img! -->
                    <div class="box-img">
                        <img src=" {{ asset('img/Checkmark.png') }}" />
                    </div>
                    <div class="box-text">
                        <h2>
                            Student Success
                        </h2>
                        <p class="lead">
                            Give students a better <br>understanding of what is expected <br>of them, and what they will <br>accomplish in different courses.
                        </p>
                    </div>
                </div>
                <div class="col-sm">
                    <!-- replace this with img! -->
                    <div class="box-img">
                        <img src=" {{ asset('img/Checkmark.png') }}" />
                    </div>
                    <div class="box-text">
                        <h2>
                            Quality Assurance
                        </h2>
                        <p class="lead">
                            Allow for identification of gaps in <br>course offerings as well as <br>redundancies.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row pb-sm-5">
                <div class="col-sm">
                    <!-- replace this with img! -->
                    <div class="box-img">
                        <img src=" {{ asset('img/Checkmark.png') }}" />
                    </div>
                    <div class="box-text">
                        <h2>
                            Improve Learning
                        </h2>
                        <p class="lead">
                            Help faculty use <br>evidence-based information, <br>see relationships between <br>course and overall program <br>goals, and learning outcomes.
                        </p>
                    </div>
                </div>
                <div class="col-sm">
                    <!-- replace this with img! -->
                    <div class="box-img">
                        <img src=" {{ asset('img/Checkmark.png') }}" />
                    </div>
                    <div class="box-text">
                        <h2>
                            Staff Collaboration
                        </h2>
                        <p class="lead">
                            Provice an opportunity for faculty <br>to work together and help new <br>faculty develop professional <br>relationships and a sense of <br>belonging.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row p-md-5 justify-content-center text-light bg-primary">
        <div class="container">
                <div class="col-md font-weight-bold">

                    <h1><strong>How to Use</strong></h1>
                    
                    <p class="lead">
                        In order to use this tool, users must have identified the:
                    </p>

                    <ol style="list-style-type: none;">
                        <li class="lead" >Course/program learning outcomes</li>
                        <li class="lead" >Assessment methods (e.g. quizzes, oral presentation, research paper, etc.)</li>
                        <li class="lead" >Teaching and learning activities (e.g. lecture, problem-based learning, lab, tutorial, discussion, etc.)</li>
                    </ol>

                    <p class="lead">
                        Be ready to input this information when prompted by the application. The tool will walk you through a series of steps ending with a summary of your curriculum alignment.
                    </p>
                </div>
        </div>
    </div>

    <div class="row p-md-5 justify-content-center text-dark bg-secondary">
        <div class="container">
            <div class="col-md">
                <h1><strong>Questions ?</strong></h1>
                <p class="lead">
                    If you have questions about the Curriculum MAP, please contact <a href="mailto:laura.prada@ubc.ca" target="_blank">laura.prada@ubc.ca</a> at the <a href="https://provost.ok.ubc.ca/" target="_blank">Office of the Provost and Vice-President Academic, UBC Okanagan campus</a>.
                </p>

            </div>
        </div>
    </div>
@endsection
