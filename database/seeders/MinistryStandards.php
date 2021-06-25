<?php

namespace Database\Seeders;

use App\Models\MinistryStandard;
use Illuminate\Database\Seeder;

class MinistryStandards extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Undergraduate Ministry Standards 1 - 6:
        //

        $ms = new MinistryStandard;
        $ms->msc_id= 1;
        $ms->ms_shortphrase='Depth and Breadth of Knowledge';
        $ms->ms_outcome='Basic understanding of the range of fields within the discipline/field. 
            Ability to gather, review, evaluate and interpret information, including new information relevant to the discipline.
            Capacity to engage in independent research or practice in a supervised context.
            Critical thinking/analytical skills.
            Ability to apply learning from one or more areas outside the discipline.';
        $ms->save();

        $ms2 = new MinistryStandard;
        $ms2->msc_id= 1;
        $ms2->ms_shortphrase='Knowledge of Methodologies and Research';
        $ms2->ms_outcome='Evaluate the appropriateness of different approaches to solving problems using well established ideas and techniques. 
        Devise and sustain arguments or solve problems using these methods. 
        Describe and comment upon particular aspects of current research or equivalent advanced scholarship in the discipline.';
        $ms2->save();

        $ms3 = new MinistryStandard;
        $ms3->msc_id= 1;
        $ms3->ms_shortphrase='Communications Skills';
        $ms3->ms_outcome='Ability to communicate information, arguments, and analyses accurately and reliably, orally and in writing, to a range of audiences. 
        Use structured and coherent arguments.';
        $ms3->save();

        $ms4 = new MinistryStandard;
        $ms4->msc_id= 1;
        $ms4->ms_shortphrase='Application of Knowledge';
        $ms4->ms_outcome='Ability to review, present and critically evaluate qualitative and quantitative information to develop an argument, make sound judgement, apply concept, or use this knowledge in the creative process.';
        $ms->save();

        $ms5 = new MinistryStandard;
        $ms5->msc_id= 1;
        $ms5->ms_shortphrase='Awareness of Limits of Knowledge';
        $ms5->ms_outcome='Understanding of the limits to their own knowledge and ability. 
        Appreciation of the uncertainty, ambiguity and limits to knowledge and how this might influence analyses and interpretations.';
        $ms5->save();

        $ms6 = new MinistryStandard;
        $ms6->msc_id= 1;
        $ms6->ms_shortphrase='Professional Capacity/Autonomy';
        $ms6->ms_outcome='Initiative, personal responsibility and accountability in both personal and group contexts. Working effectively with others. Behavior consistent with academic integrity.';
        $ms6->save();

        //
        // Masters Degree Ministry Standards 7 - 12:
        //

        $ms7 = new MinistryStandard;
        $ms7->msc_id= 2;
        $ms7->ms_shortphrase='Depth and Breadth of Knowledge';
        $ms7->ms_outcome='Systematic understanding of knowledge, and a critical awareness of current problems and/or new insights, much of which is at, or informed by, the forefront of their academic discipline, field of study, or area of professional practice.';
        $ms7->save();

        $ms8 = new MinistryStandard;
        $ms8->msc_id= 2;
        $ms8->ms_shortphrase='Knowledge of Methodologies and Research';
        $ms8->ms_outcome='Working comprehension of how established techniques of research and inquiry are used to create and interpret knowledge in the discipline.
        Capacity to evaluate critically current research and advanced research and scholarship in the discipline or area of professional competence.
        Capacity to address complex issues and judgments based on established principles and techniques. 
        Demonstrated ability to develop and support of a sustained argument in written form. Originality in the application of knowledge.';
        $ms8->save();

        $ms9 = new MinistryStandard;
        $ms9->msc_id= 2;
        $ms9->ms_shortphrase='Communications Skills';
        $ms9->ms_outcome='Ability to communicate ideas, issues and conclusions clearly and effectively to specialist and non-specialist audiences.';
        $ms9->save();

        $ms10 = new MinistryStandard;
        $ms10->msc_id= 2;
        $ms10->ms_shortphrase='Application of Knowledge';
        $ms10->ms_outcome='Competency in the research process by applying an existing body of knowledge in the research and critical analysis of a new question or of a specific problem or issue in a new setting.';
        $ms10->save();

        $ms11 = new MinistryStandard;
        $ms11->msc_id= 2;
        $ms11->ms_shortphrase='Awareness of Limits of Knowledge';
        $ms11->ms_outcome='Cognizance of the complexity of knowledge and of the potential contributions of other interpretations, methods, and disciplines.';
        $ms11->save();

        $ms12 = new MinistryStandard;
        $ms12->msc_id= 2;
        $ms12->ms_shortphrase='Professional Capacity/Autonomy';
        $ms12->ms_outcome='Exercise of initiative and of personal responsibility and accountability. Decision-making in complex situations, such as employment. 
        Intellectual independence required for continuing professional development. Ability to appreciate the broader implications of applying knowledge to particular contexts.';
        $ms12->save();

        //
        // Masters Degree Ministry Standards 13 - 18:
        //

        $ms13 = new MinistryStandard;
        $ms13->msc_id= 3;
        $ms13->ms_shortphrase='Depth and Breadth of Knowledge';
        $ms13->ms_outcome='Thorough understanding of a substantial body of knowledge that is at the forefront of their academic discipline or area of professional practice.';
        $ms13->save();

        $ms14 = new MinistryStandard;
        $ms14->msc_id= 3;
        $ms14->ms_shortphrase='Knowledge of Methodologies and Research';
        $ms14->ms_outcome='Conceptualize, design, and implement research for the generation of new knowledge, applications, or understanding at the forefront of the discipline, and to adjust the research design or methodology in the light of unforeseen problems. 
        Make informed judgments on complex issues in specialist fields, sometimes requiring new methods.Produce original research, or other advanced scholarship, of a quality to satisfy peer review, and to merit publication.';
        $ms14->save();

        $ms15 = new MinistryStandard;
        $ms15->msc_id= 3;
        $ms15->ms_shortphrase='Communications Skills';
        $ms15->ms_outcome='Ability to communicate complex and/or ambiguous ideas, issues and conclusions clearly and effectively.';
        $ms15->save();

        $ms16 = new MinistryStandard;
        $ms16->msc_id= 3;
        $ms16->ms_shortphrase='Application of Knowledge';
        $ms16->ms_outcome='Capacity to undertake pure and/or applied research at an advanced level. 
        Capacity to contribute to the development of academic or professional skill, techniques, tools, practices, ideas, theories, approaches, and/or materials.';
        $ms16->save();

        $ms17 = new MinistryStandard;
        $ms17->msc_id= 3;
        $ms17->ms_shortphrase='Awareness of Limits of Knowledge';
        $ms17->ms_outcome='Appreciation of the limitations of one’s own work and discipline, of the complexity of knowledge, and of the potential contributions of other interpretations, methods, and disciplines.';
        $ms17->save();

        $ms18 = new MinistryStandard;
        $ms18->msc_id= 3;
        $ms18->ms_shortphrase='Professional Capacity/Autonomy';
        $ms18->ms_outcome='Exercise of personal responsibility and largely autonomous initiative in complex situations. 
        Intellectual independence to be academically and professionally engaged and current. 
        Ability to evaluate the broader implications of applying knowledge to particular contexts.';
        $ms18->save();
    }
}
