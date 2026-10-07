import { Controller, Get } from '@nestjs/common';

@Controller('health')
export class HealthController {
  @Get('live')
  checkLiveness() {
    return { status: 'ok', message: 'API is live' };
  }

  @Get('ready')
  checkReadiness() {
    // Check DB connection here eventually
    return { status: 'ok', message: 'API is ready' };
  }
}
