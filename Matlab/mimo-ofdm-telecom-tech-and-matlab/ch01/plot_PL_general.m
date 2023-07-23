% ���Ʋ�ͬ��·�����ģ��
clear all, clf, clc

fc = 1.5e9;
d0 = 100;
sigma = 3;
distance = [1:2:3].^2;
Gt = [1 1 0.5];
Gr = [1 0.5 0.5];
Exp = [2 3 6];
for k = 1:3
    y_Free(k,:) = PL_free(fc, distance, Gt(k), Gr(k));
    y_logdist(k,:) = PL_logdist_or_norm(fc, distance, d0, Exp(k));
    y_lognorm(k,:) = PL_logdist_or_norm(fc, distance, d0, Exp(1), sigma);
end

subplot(1,3,1)
semilogx(distance, y_Free(1,:),'k-o', distance, y_Free(2,:),'k-^', distance, y_Free(3,:),'k-s')
grid on, axis([1 1000 40 110])
title(['Free PL-loss Model, f_c=',num2str(fc/1e6),'MHz'])
xlabel('Distance[m]'), ylabel('Path loss[dB]')
legend('G_t=1, G_r=1','G_t=1,G_r=0.5','G_t=0.5,G_r=0.5',2)

subplot(1,3,2)