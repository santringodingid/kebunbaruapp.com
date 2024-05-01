<?php

namespace Database\Seeders;

use App\Models\SettingManagement\Period;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Period::query()->create(['diniyah' => '1425-1426', 'ammiyah' => '2004-2005', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1426-1427', 'ammiyah' => '2005-2006', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1427-1428', 'ammiyah' => '2006-2007', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1428-1429', 'ammiyah' => '2007-2008', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1429-1430', 'ammiyah' => '2008-2009', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1430-1431', 'ammiyah' => '2009-2010', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1431-1432', 'ammiyah' => '2010-2011', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1432-1433', 'ammiyah' => '2011-2012', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1433-1434', 'ammiyah' => '2012-2013', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1434-1435', 'ammiyah' => '2013-2014', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1435-1436', 'ammiyah' => '2014-2015', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1436-1437', 'ammiyah' => '2015-2016', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1437-1438', 'ammiyah' => '2016-2017', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1438-1439', 'ammiyah' => '2017-2018', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1439-1440', 'ammiyah' => '2018-2019', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1440-1441', 'ammiyah' => '2019-2020', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1441-1442', 'ammiyah' => '2020-2021', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1442-1443', 'ammiyah' => '2021-2022', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1443-1444', 'ammiyah' => '2022-2023', 'created_at' => Carbon::now()]);
        Period::query()->create(['diniyah' => '1444-1445', 'ammiyah' => '2023-2024', 'created_at' => Carbon::now()]);
    }
}
