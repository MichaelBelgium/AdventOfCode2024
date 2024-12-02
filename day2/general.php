<?php

enum ReportFlow
{
    case Increasing;
    case Decreasing;
}


function isSafe(array $report, int $tolarates = 0): bool
{
    /*
     * The levels are either all increasing or all decreasing.
     * Any two adjacent levels differ by at least one and at most three.
     *
     * Part 2 introduces "tolarates" which is the amount of times we can ignore the rules per report.
     */

    $initialState = null;

    for ($i = 0; $i < count($report) - 1; $i++)
    {
        ///region Any two adjacent levels differ by at least one and at most three.
        $diff = $report[$i] - $report[$i + 1];

        if ($diff < 0)
            $diff = abs($diff);

        if ($diff < 1 || $diff > 3)
        {
            if ($tolarates > 0)
            {
                $tolarates--;
                continue;
            }
            return false;
        }
        ///endregion

        ///region The levels are either all increasing or all decreasing.
        $diff = $report[$i] - $report[$i + 1];

        if ($initialState === null)
            $initialState = $diff > 0 ? ReportFlow::Decreasing : ReportFlow::Increasing;
        else
        {
            if ($diff > 0)
            {
                if ($initialState == ReportFlow::Increasing)
                {
                    if ($tolarates > 0)
                    {
                        $tolarates--;
                        continue;
                    }
                    return false;
                }
            }
            elseif ($diff < 0)
            {
                if ($initialState == ReportFlow::Decreasing)
                {
                    if ($tolarates > 0)
                    {
                        $tolarates--;
                        continue;
                    }
                    return false;
                }
            }
        }
        ///endregion
    }

    return true;
}