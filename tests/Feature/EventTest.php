<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_events(): void
    {
        $events = Event::factory()->count(3)->create();
        $response = $this->get('/api/events');
        $response->assertStatus(200)->assertJsonCount(3);
        
    }

    public function test_can_show_events(): void
    {
        $event = Event::factory()->create();
        $response = $this->getJson("/api/events/{$event->id}");
        $response->assertStatus(200)->
        assertJsonStructure([
            'success',
            'message',
            'result' =>[
                'id',
                'name',
                'description',
                'start_date',
                'end_date',
                'ticket_count',
            ],
        ]);
    }

    public function test_can_create_event()
    {
        $data = [
            'name' => 'test',
            'description' => 'test',
            'start_date' => '2024-08-01T02:21:00.000000Z',
            'end_date' => '2024-08-02T02:21:00.000000Z',
            'ticket_count' => 100,
        ];
        $response = $this->postJson('/api/events', $data);
        $response->assertStatus(200) 
                 ->assertJson([
                     'success' => true,
                     'message' => 'Events created successfully',
                     'result' =>$data
                 ]);
    }

    
    public function test_can_update_event(): void
    {
        $event = Event::factory()->create();
        $data = ['name' => 'Updated Event Name','description'=>'test update','start_date'=>'2025-2-9','end_date'=>'2025-8-1','ticket_count'=>10];
        $response = $this->putJson("/api/events/{$event->id}", $data);
        $response->assertStatus(200);
    }

    public function test_can_delete_event(): void
    {
       $event = Event::factory()->create();
        $response = $this->deleteJson("/api/events/{$event->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }
  
    
}
