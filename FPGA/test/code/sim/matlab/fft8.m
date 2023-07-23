clear all;close all;clc;
%=======================================================
% 8dots fft
%=======================================================
for r=0:3
    Wnr(r+1)  = cos(pi/4*r) - j*sin(pi/4*r) ;
end
x       = [10, 20, 30, 40, 10, 20 ,30 ,40];
step    = [1+2j, 1+5j, 31+3j, 1+6j, 23+4j, 1+8j, 6+11j, 1+7j];
x2      = x + step;
xm0     = [x2(0+1), x2(4+1), x2(2+1), x2(6+1), x2(1+1), x2(5+1),         x2(3+1), x2(7+1)] ;

%% stage1
xm1(1) = xm0(1) + xm0(2)*Wnr(1) ;
xm1(2) = xm0(1) - xm0(2)*Wnr(1) ;
xm1(3) = xm0(3) + xm0(4)*Wnr(1) ;
xm1(4) = xm0(3) - xm0(4)*Wnr(1) ;
xm1(5) = xm0(5) + xm0(6)*Wnr(1) ;
xm1(6) = xm0(5) - xm0(6)*Wnr(1) ;
xm1(7) = xm0(7) + xm0(8)*Wnr(1) ;
xm1(8) = xm0(7) - xm0(8)*Wnr(1) ;
floor(xm1(:))

%% stage2
xm2(1) = xm1(1) + xm1(3)*Wnr(1) ;
xm2(3) = xm1(1) - xm1(3)*Wnr(1) ;
xm2(2) = xm1(2) + xm1(4)*Wnr(2) ;
xm2(4) = xm1(2) - xm1(4)*Wnr(2) ;
xm2(5) = xm1(5) + xm1(7)*Wnr(1) ;
xm2(7) = xm1(5) - xm1(7)*Wnr(1) ;
xm2(6) = xm1(6) + xm1(8)*Wnr(2) ;
xm2(8) = xm1(6) - xm1(8)*Wnr(2) ;
floor(xm2(:))

%% stage3
xm3(1) = xm2(1) + xm2(5)*Wnr(1) ;
xm3(5) = xm2(1) - xm2(5)*Wnr(1) ;
xm3(2) = xm2(2) + xm2(6)*Wnr(2) ;
xm3(6) = xm2(2) - xm2(6)*Wnr(2) ;
xm3(3) = xm2(3) + xm2(7)*Wnr(3) ;
xm3(7) = xm2(3) - xm2(7)*Wnr(3) ;
xm3(4) = xm2(4) + xm2(8)*Wnr(4) ;
xm3(8) = xm2(4) - xm2(8)*Wnr(4) ;
floor(xm3(:))

%% fft
fft1 = fft(x)
fft2 = fft(x2)
plot(1:8, abs(fft2))
hold on
plot(1:8, abs(xm3), 'r')