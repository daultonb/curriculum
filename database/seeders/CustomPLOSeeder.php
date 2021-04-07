<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Custom_program_learning_outcomes;

class CustomPLOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wef1 = new Custom_program_learning_outcomes();
        $wef1->custom_plo = "Analytical thinking and innovation";
        $wef1->custom_program_id = 1;
        $wef1->custom_program_name = "World Economic Forum 2020";
        $wef1->save();

        $wef2 = new Custom_program_learning_outcomes();
        $wef2->custom_plo = "Active learning and learning strategies";
        $wef2->custom_program_id = 1;
        $wef2->custom_program_name = "World Economic Forum 2020";
        $wef2->save();

        $wef3 = new Custom_program_learning_outcomes();
        $wef3->custom_plo = "Complex problem-solving";
        $wef3->custom_program_id = 1;
        $wef3->custom_program_name = "World Economic Forum 2020";
        $wef3->save();

        $wef4 = new Custom_program_learning_outcomes();
        $wef4->custom_plo = "Critical thinking and analysis";
        $wef4->custom_program_id = 1;
        $wef4->custom_program_name = "World Economic Forum 2020";
        $wef4->save();

        $wef5 = new Custom_program_learning_outcomes();
        $wef5->custom_plo = "Creativity, originality and initiative";
        $wef5->custom_program_id = 1;
        $wef5->custom_program_name = "World Economic Forum 2020";
        $wef5->save();

        $wef6 = new Custom_program_learning_outcomes();
        $wef6->custom_plo = "Leadership and social influence";
        $wef6->custom_program_id = 1;
        $wef6->custom_program_name = "World Economic Forum 2020";
        $wef6->save();

        $wef7 = new Custom_program_learning_outcomes();
        $wef7->custom_plo = "Technology use, monitoring and control";
        $wef7->custom_program_id = 1;
        $wef7->custom_program_name = "World Economic Forum 2020";
        $wef7->save();

        $wef8 = new Custom_program_learning_outcomes();
        $wef8->custom_plo = "Technology design and programming";
        $wef8->custom_program_id = 1;
        $wef8->custom_program_name = "World Economic Forum 2020";
        $wef8->save();

        $wef9 = new Custom_program_learning_outcomes();
        $wef9->custom_plo = "Resilience, stress tolerance and flexibility";
        $wef9->custom_program_id = 1;
        $wef9->custom_program_name = "World Economic Forum 2020";
        $wef9->save();

        $wef10 = new Custom_program_learning_outcomes();
        $wef10->custom_plo = "Reasoning, problem-solving and ideation";
        $wef10->custom_program_id = 1;
        $wef10->custom_program_name = "World Economic Forum 2020";
        $wef10->save();

        $wef11 = new Custom_program_learning_outcomes();
        $wef11->custom_plo = "Emotional intelligence";
        $wef11->custom_program_id = 1;
        $wef11->custom_program_name = "World Economic Forum 2020";
        $wef11->save();

        $wef12 = new Custom_program_learning_outcomes();
        $wef12->custom_plo = "Troubleshooting and user experience";
        $wef12->custom_program_id = 1;
        $wef12->custom_program_name = "World Economic Forum 2020";
        $wef12->save();

        $wef13 = new Custom_program_learning_outcomes();
        $wef13->custom_plo = "Service orientation";
        $wef13->custom_program_id = 1;
        $wef13->custom_program_name = "World Economic Forum 2020";
        $wef13->save();

        $wef14 = new Custom_program_learning_outcomes();
        $wef14->custom_plo = "Systems analysis and evaluation";
        $wef14->custom_program_id = 1;
        $wef14->custom_program_name = "World Economic Forum 2020";
        $wef14->save();

        $wef15 = new Custom_program_learning_outcomes();
        $wef15->custom_plo = "Persuasion and negotiation";
        $wef15->custom_program_id = 1;
        $wef15->custom_program_name = "World Economic Forum 2020";
        $wef15->save();

        $udl1 = new Custom_program_learning_outcomes();
        $udl1->custom_plo = "Learning outcomes are clearly stated";
        $udl1->custom_program_id = 2;
        $udl1->custom_program_name = "UDL Guidelines";
        $udl1->save();

        $udl2 = new Custom_program_learning_outcomes();
        $udl2->custom_plo = "Teaching and learning methods are diverse and present content in more than one manner";
        $udl2->custom_program_id = 2;
        $udl2->custom_program_name = "UDL Guidelines";
        $udl2->save();

        $udl3 = new Custom_program_learning_outcomes();
        $udl3->custom_plo = "Assessment methods are flexible";
        $udl3->custom_program_id = 2;
        $udl3->custom_program_name = "UDL Guidelines";
        $udl3->save();

        $udl4 = new Custom_program_learning_outcomes();
        $udl4->custom_plo = "Feedback is provided to students to contribute to their learning";
        $udl4->custom_program_id = 2;
        $udl4->custom_program_name = "UDL Guidelines";
        $udl4->save();

        $min1 = new Custom_program_learning_outcomes();
        $min1->custom_plo = "Incorporation of the Declaration on the Rights of Indigenous Peoples Act and Calls to Action of the Truth and Reconciliation Commission";
        $min1->custom_program_id = 3;
        $min1->custom_program_name = "Ministry of Advanced Education,Skills and Training";
        $min1->save();

        $min2 = new Custom_program_learning_outcomes();
        $min2->custom_plo = "Align with CleanBC's plan to a protect our communities towards a more sustainabl future";
        $min2->custom_program_id = 3;
        $min2->custom_program_name = "Ministry of Advanced Education,Skills and Training";
        $min2->save();

        $min3 = new Custom_program_learning_outcomes();
        $min3->custom_plo = "Advancing and supporting open learning resources";
        $min3->custom_program_id = 3;
        $min3->custom_program_name = "Ministry of Advanced Education,Skills and Training";
        $min3->save();

        $min4 = new Custom_program_learning_outcomes();
        $min4->custom_plo = "Offer programming aligned with high opportunity and priority occupations (such as trades,technology,early childhood educators and health)";
        $min4->custom_program_id = 3;
        $min4->custom_program_name = "Ministry of Advanced Education,Skills and Training";
        $min4->save();

        $min5 = new Custom_program_learning_outcomes();
        $min5->custom_plo = "Embed more co-op and work-integrated learning opportunities";
        $min5->custom_program_id = 3;
        $min5->custom_program_name = "Ministry of Advanced Education,Skills and Training";
        $min5->save();

        $min6 = new Custom_program_learning_outcomes();
        $min6->custom_plo = "Respond to the reskilling neds of British Columbians to support employment and career transitions";
        $min6->custom_program_id = 3;
        $min6->custom_program_name = "Ministry of Advanced Education,Skills and Training";
        $min6->save();

        $min7 = new Custom_program_learning_outcomes();
        $min7->custom_plo = "Supporting students' awareness of career planning resources(such as the Labour Market Outlook)";
        $min7->custom_program_id = 3;
        $min7->custom_program_name = "Ministry of Advanced Education,Skills and Training";
        $min7->save();

        $clim1 = new Custom_program_learning_outcomes();
        $clim1->custom_plo = "Climate justice education";
        $clim1->custom_program_id = 4;
        $clim1->custom_program_name = "UBC's Climate Priorities";
        $clim1->save();

        $clim2 = new Custom_program_learning_outcomes();
        $clim2->custom_plo = "Climate research";
        $clim2->custom_program_id = 4;
        $clim2->custom_program_name = "UBC's Climate Priorities";
        $clim2->save();

        $clim3 = new Custom_program_learning_outcomes();
        $clim3->custom_plo = "Content from Indigenous scholars and communities and/or equity-seeking and marginalized groups";
        $clim3->custom_program_id = 4;
        $clim3->custom_program_name = "UBC's Climate Priorities";
        $clim3->save();

        $clim4 = new Custom_program_learning_outcomes();
        $clim4->custom_plo = "Environmental and sustainability education";
        $clim4->custom_program_id = 4;
        $clim4->custom_program_name = "UBC's Climate Priorities";
        $clim4->save();

        $clim5 = new Custom_program_learning_outcomes();
        $clim5->custom_plo = "Inclusion of de-colonial approaches to science through Indigenous and commnity traditional knowledge and 'authorship'";
        $clim5->custom_program_id = 4;
        $clim5->custom_program_name = "UBC's Climate Priorities";
        $clim5->save();

        $clim6 = new Custom_program_learning_outcomes();
        $clim6->custom_plo = "Knowledge, awareness and skills related to the relationship between climate change and food systems";
        $clim6->custom_program_id = 4;
        $clim6->custom_program_name = "UBC's Climate Priorities";
        $clim6->save();

        $clim7 = new Custom_program_learning_outcomes();
        $clim7->custom_plo = "Climate-related metal health content";
        $clim7->custom_program_id = 4;
        $clim7->custom_program_name = "UBC's Climate Priorities";
        $clim7->save();

        $clim8 = new Custom_program_learning_outcomes();
        $clim8->custom_plo = "Applied learning opportunities grounded in the personal, local and regional community (eg. flood and wildfire impacted communities in BC)";
        $clim8->custom_program_id = 4;
        $clim8->custom_program_name = "UBC's Climate Priorities";
        $clim8->save();

        $clim9 = new Custom_program_learning_outcomes();
        $clim9->custom_plo = "Content on Indienous rights, content, history, and culture";
        $clim9->custom_program_id = 4;
        $clim9->custom_program_name = "UBC's Climate Priorities";
        $clim9->save();

        $indigeous1 = new Custom_program_learning_outcomes();
        $indigeous1->custom_plo = "Integration of Indigenous histories, experiences, worldviews and knowledge systems";
        $indigeous1->custom_program_id = 5;
        $indigeous1->custom_program_name = "Indigenous Strategic Plan";
        $indigeous1->save();

        $indigeous2 = new Custom_program_learning_outcomes();
        $indigeous2->custom_plo = "Inclusion of substantive content that explores histories and identifies how Indigenous issues intersect with the field of study";
        $indigeous2->custom_program_id = 5;
        $indigeous2->custom_program_name = "Indigenous Strategic Plan";
        $indigeous2->save();

        $indigeous3 = new Custom_program_learning_outcomes();
        $indigeous3->custom_plo = "Inclusion of Indigenous people for the development and offering of the curriculum";
        $indigeous3->custom_program_id = 5;
        $indigeous3->custom_program_name = "Indigenous Strategic Plan";
        $indigeous3->save();

        $indigeous4 = new Custom_program_learning_outcomes();
        $indigeous4->custom_plo = "Continus to partner with Indigenous communities locally and globally";
        $indigeous4->custom_program_id = 5;
        $indigeous4->custom_program_name = "Indigenous Strategic Plan";
        $indigeous4->save();
    }
}
