<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;

class PublishScheduledBlogs extends Command
{
    protected $signature = 'blogs:publish-scheduled';

    protected $description = 'Publish blog posts whose scheduled time has passed';

    public function handle(): int
    {
        $count = Blog::publishDueScheduled();

        if ($count > 0) {
            $this->info("Published {$count} scheduled blog post(s).");
        } else {
            $this->line('No scheduled blog posts due for publishing.');
        }

        return self::SUCCESS;
    }
}
