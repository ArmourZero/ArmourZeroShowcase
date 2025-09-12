terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 5.0"
    }
  }

  required_version = ">= 1.0.0"
}

provider "aws" {
  region = "us-east-1"
}

# BAD SECURITY GROUP - this WILL trigger Critical in scanners
resource "aws_security_group" "bad_sg" {
  name        = "open-to-world"
  description = "Security group with wide-open ingress"

  ingress {
    description = "Allow SSH from anywhere"
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]   # 🚨 Critical issue
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]   # also bad, overly permissive egress
  }
}

# BAD S3 BUCKET - also flagged
resource "aws_s3_bucket" "bad_bucket" {
  bucket = "my-insecure-bucket-demo"

  acl    = "public-read"          # 🚨 Critical issue: bucket public
}

# NO ENCRYPTION - will be flagged
resource "aws_s3_bucket_server_side_encryption_configuration" "bad_enc" {
  bucket = aws_s3_bucket.bad_bucket.id

  rule {
    apply_server_side_encryption_by_default {
      sse_algorithm = "NONE"      # 🚨 intentionally bad
    }
  }
}
