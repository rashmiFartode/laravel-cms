<?php

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = App\User::create([
            'name' => 'sanket Tale',
            'email' => 'sanket@tale.com',
            'password' => Hash::make('password'),
        ]);

        $author2 = App\User::create([
            'name' => 'Yogita Jawade',
            'email' => 'yogita@jawade.com',
            'password' => Hash::make('password'),
        ]);

        $category1 = Category::create([
            'name' => 'News',
        ]);

        $category2 = Category::create([
            'name' => 'Marketing',
        ]);

        $category3 = Category::create([
            'name' => 'Partnership',
        ]);

        $category4 = Category::create([
            'name' => 'Design',
        ]);

        $category5 = Category::create([
            'name' => 'Hiring',
        ]);

        $category6 = Category::create([
            'name' => 'Product',
        ]);

        $post1 = $author1->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever                       since the 1500s',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suered alteration in some form, by injected humour, or                randomised words which don t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt                anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predened chunks as                        necessary,',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
            'published_at' => '2019-12-21 17:31:30'
        ]);

        $post2 = $author1->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever                       since the 1500s',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suered alteration in some form, by injected humour, or                randomised words which don t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt                anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predened chunks as                        necessary,',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg',
            'published_at' => '2019-12-21 17:31:30'
        ]);

        $post3 = $author1->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever                       since the 1500s',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suered alteration in some form, by injected humour, or                randomised words which don t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt                anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predened chunks as                        necessary,',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg',
            'published_at' => '2019-12-21 17:31:30'
        ]);

        $post4 = $author2->posts()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever                       since the 1500s',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suered alteration in some form, by injected humour, or                randomised words which don t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt                anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predened chunks as                        necessary,',
            'category_id' => $category4->id,
            'image' => 'posts/4.jpg',
            'published_at' => '2019-12-21 17:31:30'
        ]);

        $post5 = $author2->posts()->create([
            'title' => 'New published books to read by a product designer',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever                       since the 1500s',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suered alteration in some form, by injected humour, or                randomised words which don t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt                anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predened chunks as                        necessary,',
            'category_id' => $category5->id,
            'image' => 'posts/5.jpg',
            'published_at' => '2019-12-21 17:31:30'
        ]);

        $post6 = $author2->posts()->create([
            'title' => 'This is why it time to ditch dress codes at work',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever                       since the 1500s',
            'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suered alteration in some form, by injected humour, or                randomised words which don t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt                anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predened chunks as                        necessary,',
            'category_id' => $category6->id,
            'image' => 'posts/6.jpg',
            'published_at' => '2019-12-21 17:31:30'
        ]);

        $tag1 = Tag::create([
            'name' => 'Record',
        ]);

        $tag2 = Tag::create([
            'name' => 'Progress',
        ]);

        $tag3 = Tag::create([
            'name' => 'Customers',
        ]);

        $tag4 = Tag::create([
            'name' => 'Screenshot',
        ]);


        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag3->id, $tag4->id]);
        $post4->tags()->attach([$tag4->id, $tag1->id]);
        $post5->tags()->attach([$tag1->id, $tag2->id]);
    }
}
