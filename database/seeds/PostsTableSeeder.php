<?php
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     */

    public function run()
    {
        //
        $author1 = User::create([
            'name' => 'Disha Savani',
            'email' => 'nisha@gmail.com',
            'password' => Hash::make('password')
        ]);

        $author2 = User::create([
            'name' => 'Nilesh Savani',
            'email' => 'nilesh@gmail.com',
            'password' => Hash::make('password')
        ]);
        $category1 = Category::create([
            'name' => 'News'
        ]);

        $category2 = Category::create([
            'name' => 'Marketing'
        ]);

        $category3 = Category::create([
            'name' => 'Partnership'
        ]);

        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'decription' => 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. ',
            'content' => 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. ',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
            'user_id' => $author1 ->id

        ]);

        $post2 =$author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'decription' => 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. ',
            'content' => 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. ',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg'


        ]);

        $post3 = $author1->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'decription' => 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. ',
            'content' => 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. ',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg'


        ]);

        $post4 = $author2->posts()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'decription' => 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. ',
            'content' => 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. ',
            'category_id' => $category2->id,
            'image' => 'posts/4.jpg'


        ]);

        $tag1 = Tag::create([
            'name' => 'Job'
        ]);

        $tag2 = Tag::create([
            'name' => 'Customers'
        ]);

        $tag3 = Tag::create([
            'name' => 'Record'
        ]);

        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag2->id,$tag3->id]);
        $post3->tags()->attach([$tag3->id,$tag1->id]);


    }

}

