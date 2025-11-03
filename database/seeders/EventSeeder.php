<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user or create one
        $user = User::first();
        
        if (!$user) {
            return; // No users exist yet
        }

        $events = [
            [
                'title' => 'JCI Poland National Online Convention 2025',
                'description' => 'JCI Poland National Online Convention 2025 is making its highly anticipated return to Poland in the 6th of September. Africa\'s premier wine trade show, held every three years, will once again take place in the vibrant heart of the Mother City at the JCI Poland National Online Convention 2025. We warmly invite you to join us for this exclusive opportunity to engage directly with the South African wine industry leaders, discover innovative products, and forge meaningful business connections in an environment designed for success.',
                'event_date' => Carbon::parse('2025-09-06'),
                'event_time' => '01:00:00',
                'location' => 'Mercure Poznan Centrum',
                'country' => 'Poland',
                'attendees_count' => 120,
                'status' => 'published',
            ],
            [
                'title' => 'No Matter What Foundation 5K Run/Walk',
                'description' => 'Join us for a meaningful 5K run/walk to support the No Matter What Foundation. This event brings together our community to raise awareness and funds for mental health initiatives. All fitness levels welcome! Enjoy a scenic route, refreshments, and the satisfaction of making a difference.',
                'event_date' => Carbon::parse('2025-09-07'),
                'event_time' => '08:00:00',
                'location' => 'East Islip Community Park',
                'country' => 'United States',
                'attendees_count' => 85,
                'status' => 'published',
            ],
            [
                'title' => '6th Congress on Intelligent Systems 2025',
                'description' => 'The 6th Congress on Intelligent Systems brings together researchers, practitioners, and industry leaders to discuss the latest advancements in AI and machine learning. Join us for three days of insightful presentations, workshops, and networking opportunities. This hybrid event allows both in-person and virtual participation.',
                'event_date' => Carbon::parse('2025-09-08'),
                'event_time' => '09:00:00',
                'location' => 'MIT Conference Center',
                'country' => 'United States',
                'attendees_count' => 200,
                'status' => 'published',
            ],
            [
                'title' => 'The NGO Whisperer Masterclass',
                'description' => 'Learn the secrets of effective NGO management and fundraising from industry expert Carolyn A. Deepen, MPA. This virtual masterclass will cover strategic planning, donor relations, impact measurement, and sustainable growth strategies for non-profit organizations. Perfect for NGO leaders, board members, and aspiring changemakers.',
                'event_date' => Carbon::parse('2025-09-09'),
                'event_time' => '14:00:00',
                'location' => 'Virtual Event',
                'country' => null,
                'attendees_count' => 45,
                'status' => 'published',
            ],
        ];

        foreach ($events as $eventData) {
            Event::create(array_merge($eventData, ['user_id' => $user->id]));
        }
    }
}

