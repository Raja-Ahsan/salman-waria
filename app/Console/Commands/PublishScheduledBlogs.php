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
        $count = 0;

        Blog::query()
            ->where('status', 'scheduled')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', now())
            ->orderBy('id')
            ->each(function (Blog $blog) use (&$count) {
                $blog->update([
                    'status' => 'published',
                    'published_at' => $blog->scheduled_at,
                    'scheduled_at' => null,
                ]);
                $count++;
            });

        if ($count > 0) {
            $this->info("Published {$count} scheduled blog post(s).");
        }

        return self::SUCCESS;
    }
}
