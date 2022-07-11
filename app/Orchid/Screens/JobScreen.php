<?php

namespace App\Orchid\Screens;

use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class JobScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $table = "<<<
 <table>
<th>ID</th>
<th>NAME</th>
<th>DAY</th>
<tr>
<td>1</td>
<td>Job</td>
<td>Monday</td>
</tr>
</table>
>>>";

        return [
            "jobs" => $table
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'JobScreen';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table("jobs",[
                TD::make("id"),
            ])
        ];
    }
}
