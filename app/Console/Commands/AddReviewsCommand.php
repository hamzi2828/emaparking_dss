<?php

namespace App\Console\Commands;

use App\Models\ParsedEmails;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Modules\Booking\Models\Booking;
use Modules\Review\Models\Review;

class AddReviewsCommand extends Command
{
    protected $signature = 'reviews:add';

    protected $description = 'This command is used to add reviews in then database about spaces.';

    public function handle()
    {

        $this->info('Adding reviews started...');

        Review::truncate();
        $this->info('Truncated Old Reviews');

        $review = [
            'id'=> 1,
            'object_id'=> 16,
            'object_model' => "space",
            'title' => "",
            "content"=> "",
            "rate_number" => 5,
            "author_ip" => "127.0.0.1",
            "status"=> "approved",
            "publish_date"=> "2023-03-29 03:31:30",
            "create_user"=> null,
            "update_user"=> null,
            "deleted_at"=> null,
            "lang"=> null,
            "created_at"=> "2023-03-29 03:31:30",
            "updated_at"=> "2023-06-05 16:27:40",
            "vendor_id"=> 1,
            "author_id"=> null,
        ];

        $reviewsData = [
            ["They made the whole process incredibly easy and stress-free.",5,"2023-03-29 23:31:30",16],
            ["Prompt and reliable service. I was thoroughly impressed.",5,"2023-04-30 13:49:30",16],
            ["The level of professionalism displayed was remarkable.",5,"2023-02-19 14:22:30",16],
            ["I had high expectations, and they managed to exceed them.",5,"2023-05-15 09:55:30",16],
            ["The parking facility had designated spots for electric vehicles, which was a great initiative for sustainability.",5,"2023-06-01 15:12:30",16],
            ["The parking attendants were courteous and helped me with directions to my destination from the parking area.",5,"2023-02-25 17:22:30",16],
            ["The parking process was quick and straightforward, allowing me to continue with my plans promptly.",5,"2023-03-15 14:55:30",16],
            ["The parking area had a covered section, protecting my car from harsh weather conditions.",5,"2023-04-21 16:22:30",16],
            ["Prompt and reliable service. I was thoroughly impressed.",5,"2023-05-18 11:33:30",16],

            ["They said best experience, they provided as well.",4.5,"2023-02-01 18:55:30",14],
            ["It was a great experience",4.5,"2023-02-05 12:06:30",14],
            ["Though it took 5 minutes more, but booking and overall experience was great",4.5,"2023-02-10 15:44:30",14],
            ["I did not receive any confirmation, but their support is super active and email away. Awesome experience. ",4.5,"2023-02-15 20:22:30",14],
            ["Left for a month, and got back to receive the car with no problem. ",4.5,"2023-02-22 11:50:30",14],
            ["Best prices, and best experience",4.5,"2023-03-15 18:56:30",14],
            ["The service exceeded my expectations. Highly recommended!",4.5,"2023-03-17 11:17:30",14],
            ["Quick and efficient process. Impressed with their professionalism.",4.5,"2023-03-27 16:22:30",14],
            ["Their attention to detail made the whole experience exceptional.",4.5,"2023-03-29 15:33:30",14],
            ["I had a wonderful time and would definitely use their service again.",4.5,"2023-04-02 09:44:30",14],
            ["Everything went smoothly, and the staff was friendly and helpful.",4.5,"2023-04-06 17:31:30",14],
            ["Top-notch service at an affordable price.",4.5,"2023-04-14 15:43:30",14],
            ["They went above and beyond to ensure my satisfaction.",4.5,"2023-04-16 17:45:30",14],
            ["I felt like a valued customer throughout the entire process.",4.5,"2023-04-19 13:55:30",14],
            ["The staff was knowledgeable and provided excellent assistance.",4.5,"2023-04-26 12:43:30",14],
            ["I had a fantastic experience from beginning to end.",4.5,"2023-05-01 11:57:30",14],
            ["I will definitely recommend their service to family and friends.",4.5,"2023-05-09 13:56:30",14],
            ["The overall experience was superb. I couldn't ask for more.",4.5,"2023-05-13 16:51:30",14],
            ["They made me feel like a VIP. Exceptional treatment.",4.5,"2023-05-18 19:37:30",14],
            ["The booking process was a breeze, and the service was outstanding.",4.5,"2023-05-20 20:18:30",14],
            ["I was pleasantly surprised by the exceptional service they provided.",4.5,"2023-05-21 17:44:30",14],
            ["The staff was attentive and made sure all my needs were met.",4.5,"2023-05-24 09:17:30",14],
            ["The parking facility was well-maintained and provided a positive experience.",4.5,"2023-05-25 10:12:30",14],
            ["I found a parking spot easily, and the overall experience was hassle-free.",4.5,"2023-05-27 11:19:30",14],
            ["The parking attendants were helpful and guided me to an available spot. Great service!",4.5,"2023-05-28 18:09:30",14],
            ["The parking rates were reasonable, and I felt it was worth the price.",4.5,"2023-05-29 09:59:30",14],
            ["Despite it being a busy day, I managed to find parking without much difficulty. Good experience overall.",4.5,"2023-05-29 10:12:30",14],
            ["The parking facility had ample space, and I didn't have to worry about finding a spot.",4.5,"2023-05-29 15:19:30",14],
            ["The parking attendants were courteous and provided excellent assistance throughout my visit.",4.5,"2023-05-29 16:21:30",14],
            ["The parking area was secure, and I felt confident leaving my car there.",4.5,"2023-05-30 07:11:30",14],
            ["I appreciated the convenient location of the parking facility, making it easily accessible.",4.5,"2023-05-30 08:44:30",14],
            ["The parking process was efficient, and I didn't encounter any delays or issues.",4.5,"2023-05-30 12:41:30",14],
            ["The parking area was clean and well-organized, creating a pleasant experience.",4.5,"2023-06-03 19:21:30",14],
            ["I had a question about the parking rates, and the staff was quick to provide helpful information.",4.5,"2023-06-03 22:56:30",14],
            ["The parking facility had clear signage, making it easy to navigate and find available spots.",4.5,"2023-06-04 12:56:30",14],
            ["The parking attendants were professional and ensured a smooth experience for all visitors.",4.5,"2023-06-05 11:56:30",14],
            ["I was running late, but the parking attendants managed to find me a spot quickly. Great service!",4.5,"2023-06-05 12:22:30",14],

            ["Excellent customer service from start to finish.",4,"2023-03-13 02:22:30",15],
            ["Seamless booking and smooth experience throughout.",4,"2023-03-16 10:50:30",15],
            ["I couldn't be happier with my experience. 10/10.",4,"2023-03-18 14:17:30",15],
            ["The quality of service was outstanding. I'm impressed!",4,"2023-03-25 15:08:30",15],
            ["The parking facility offered convenient payment options, adding to the overall positive experience.",4,"2023-03-28 22:10:30",15],
            ["The parking area was well-lit, which made me feel safe and secure during my visit.",4,"2023-04-09 18:32:30",15],
            ["The parking attendants were attentive and provided guidance when needed. Excellent customer service!",4,"2023-04-14 11:33:30",15],
            ["The parking rates were competitive compared to nearby options, making it a preferred choice.",4,"2023-04-20 09:00:30",15],
            ["I didn't have to worry about my car's safety as the parking facility had reliable security measures in place.",4,"2023-04-22 12:55:30",15],
            ["The parking facility was easily accessible from the main road, saving me time and effort.",4,"2023-04-23 15:33:30",15],
            ["The parking attendants were friendly and made me feel welcome from the moment I arrived.",4,"2023-04-26 03:10:30",15],
            ["The parking facility had designated spots for differently-abled individuals, showcasing their inclusivity.",4,"2023-04-30 11:17:30",15],
            ["The parking process was streamlined, allowing me to park my car quickly and conveniently.",4,"2023-05-01 12:43:30",15],
            ["The parking area was well-maintained, and I didn't have to worry about any damage to my vehicle.",4,"2023-05-05 12:34:30",15],
            ["The parking attendants were knowledgeable about available spots, ensuring a smooth parking experience.",4,"2023-05-05 14:53:30",15],
            ["The parking facility had convenient amenities like restrooms and nearby shops, adding to the overall convenience.",4,"2023-05-06 23:18:30",15],
            ["The parking rates were clearly displayed, and there were no hidden fees or surprises.",4,"2023-05-11 10:14:30",15],
            ["The parking attendants were proactive in managing the flow of traffic, making it easier to find a spot.",4,"2023-05-12 11:10:30",15],
            ["I received assistance with my heavy luggage from the parking attendants, which was greatly appreciated.",4,"2023-05-17 19:14:30",15],
            ["The parking facility had a user-friendly app that allowed me to reserve a spot in advance. Great convenience!",4,"2023-05-31 23:17:30",15],
            ["The parking attendants were available 24/7, providing peace of mind for overnight parking.",4,"2023-06-02 18:55:30",15],
            ["The parking area was well-paved and had clear markings, ensuring an organized parking experience.",4,"2023-06-04 11:45:30",15],

            ["They made the whole process incredibly easy and stress-free.",5,"2023-03-29 23:31:30",17],
            ["Prompt and reliable service. I was thoroughly impressed.",5,"2023-04-30 13:49:30",17],
            ["The parking facility had designated spots for differently-abled individuals, showcasing their inclusivity.",4,"2023-04-30 11:17:30",17],
            ["The parking process was streamlined, allowing me to park my car quickly and conveniently.",4,"2023-05-01 12:43:30",17],
            ["The parking area was well-maintained, and I didn't have to worry about any damage to my vehicle.",4,"2023-05-05 12:34:30",17],
            ["The parking attendants were knowledgeable about available spots, ensuring a smooth parking experience.",4,"2023-05-05 14:53:30",17],
            ["The parking facility had convenient amenities like restrooms and nearby shops, adding to the overall convenience.",4,"2023-05-06 23:18:30",17],
            ["The parking facility had clear signage, making it easy to navigate and find available spots.",4.5,"2023-06-04 12:56:30",17],
            ["The parking attendants were professional and ensured a smooth experience for all visitors.",4.5,"2023-06-05 11:56:30",17],
            ["I was running late, but the parking attendants managed to find me a spot quickly. Great service!",4.5,"2023-06-05 12:22:30",17],




        ];

        foreach ($reviewsData as $reviewData) {
            $rev = $review;
            $rev['content']=$reviewData[0];
            $rev['rate_number']=$reviewData[1];
            $rev['created_at']=Carbon::parse($reviewData[2]);
            $rev['object_id']=$reviewData[3];
            Review::create($rev);
        }

        $this->info('reviews added successfully');

    }

}
