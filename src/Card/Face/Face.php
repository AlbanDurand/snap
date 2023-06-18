<?php

namespace AlbanDurand\Snap\Card\Face;

enum Face
{
    case K;
    case Q;
    case J;
    case Ten;
    case Nine;
    case Eight;
    case Seven;
    case Six;
    case Five;
    case Four;
    case Three;
    case Two;
    case A;

    public function getLabel(): string
    {
        return match($this) {
            Face::K, Face::Q, Face::J, Face::A => $this->name,
            Face::Ten => '10',
            Face::Nine => '9',
            Face::Eight => '8',
            Face::Seven => '7',
            Face::Six => '6',
            Face::Five => '5',
            Face::Four => '4',
            Face::Three => '3',
            Face::Two => '2'
        };
    }
}