<?php

namespace App\Enums;

enum AppointmentStatusEnum: int
{
  case ACTIVE = 1;
  case CANCELED = 2;
  case FINALIZED = 3;
}
