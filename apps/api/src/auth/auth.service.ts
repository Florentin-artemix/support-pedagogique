import { Injectable, UnauthorizedException } from '@nestjs/common';
import { PrismaService } from '../database/prisma.service';

@Injectable()
export class AuthService {
  constructor(private prisma: PrismaService) {}

  async login(email: string, passwordHash: string) {
    // In real implementation, use argon2id to verify passwordHash
    const user = await this.prisma.user.findUnique({
      where: { email },
    });
    
    if (!user || !user.isActive) {
      throw new UnauthorizedException('Invalid credentials');
    }
    
    // In real app, check password match here
    // Verify password hash logic

    // Create session token and insert to Session table
    const token = 'mock-jwt-token-replace-with-real';

    return {
      success: true,
      data: {
        token,
        user: {
          id: user.id,
          firstName: user.firstName,
          lastName: user.lastName,
          email: user.email,
          role: user.role,
        }
      }
    };
  }
}
