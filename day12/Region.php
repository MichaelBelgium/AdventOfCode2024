<?php

class Region
{
    public function __construct(public readonly string $label) { }

    public int $area = 0;
    public int $perimeter = 0;
    public int $price = 0;
    private array $plots = [];

    public function calculate(): void
    {
        $this->calculateArea();
        $this->calculatePerimeter();
        $this->calculatePrice();
    }

    private function calculateArea(): void
    {
        $this->area = count($this->plots);
    }

    private function calculatePerimeter(): void
    {
        foreach ($this->plots as $plot)
        {
            [$x, $y] = $plot;

            if (!in_array([$x - 1, $y], $this->plots))
                $this->perimeter++;

            if (!in_array([$x + 1, $y], $this->plots))
                $this->perimeter++;

            if (!in_array([$x, $y - 1], $this->plots))
                $this->perimeter++;

            if (!in_array([$x, $y + 1], $this->plots))
                $this->perimeter++;
        }
    }

    private function calculatePrice(): void
    {
        $this->price = $this->area * $this->perimeter;
    }

    public function addPlot($x, $y): void
    {
        $this->plots[] = [$x, $y];
    }
}